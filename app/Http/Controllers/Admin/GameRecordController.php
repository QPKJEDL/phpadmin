<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Billflow;
use App\Models\Desk;
use App\Models\GameLabel;
use App\Models\GameRecord;
use App\Models\Order;
use App\Models\UserAccount;
use App\Models\UserMoney;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameRecordController extends Controller
{
    /**
     * 数据列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $map = array();
        if ($request->input('desk_id') != '' || $request->input('desk_id') != null) {
            $map['desk_id'] = $request->input('desk_id');
        }
        if ($request->input('boot_num') != '' || $request->input('boot_num') != null) {
            $map['boot_num'] = $request->input('boot_num');
        }
        if ($request->input('pave_num') != '' || $request->input('pave_num') != null) {
            $map['pave_num'] = $request->input('pave_num');
        }
        $gameRecord = new GameRecord();
        $gameRecord->setTable('game_record_' . date('Ymd'));
        $sql = $gameRecord->where($map);
        if (true == $request->has('create_time')) {
            $time = strtotime($request->input('create_time'));
            $date = strtotime(date('Y-m-d', $time));
            $next = strtotime('+1day', $date) - 1;
            $data = $sql->whereBetween('creatime', [$date, $next])->paginate(10)->appends($request->all());
        } else {
            $data = $sql->paginate(10)->appends($request->all());
        }
        foreach ($data as $key => &$value) {
            $data[$key]['creatime'] = date("Y-m-d H:i:s", $value['creatime']);
            $data[$key]['desk'] = $this->getDeskByDeskId($data[$key]['desk_id']);
            if ($data[$key]['type'] == 1) {//百家乐
                $data[$key]['result'] = $this->getBaccaratParseJson($data[$key]['winner']);
                if ($data[$key]['update_result_before'] != '') {
                    $data[$key]['afterResult'] = $this->getBaccaratParseJson($data[$key]['update_result_before']);
                }
            } else if ($data[$key]['type'] == 2) {//龙虎
                $data[$key]['result'] = $this->getDragonTigerJson($data[$key]['winner']);
                if ($data[$key]['update_result_before'] != '') {
                    $data[$key]['afterResult'] = $this->getDragonTigerJson($data[$key]['update_result_before']);
                }
            } else if ($data[$key]['type'] == 3) {//牛牛
                $data[$key]['result'] = $this->getFullParseJson($data[$key]['winner']);
                if ($data[$key]['update_result_before'] != '') {
                    $data[$key]['afterResult'] = $this->getFullParseJson($data[$key]['update_result_before']);
                }
            } else if ($data[$key]['type'] == 4) {

            } else {

            }
            if ($data[$key]['update_time'] != '') {
                $data[$key]['update_time'] = date("Y-m-d H:i:s", $value['update_time']);
            }
        }
        $deskArr = $this->getAllDesk();
        return view('gameRecord.list', ['list' => $data, 'input' => $request->all(), 'desk' => $deskArr, 'min' => config('admin.min_date')]);
    }

    /**
     * 编辑页
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(StoreRequest $request)
    {
        //获取id
        $id = $request->input('id');
        $time = $request->input('time');
        $tableSuf = $this->getGameRecordTableName($time);
        $game = new GameRecord();
        $game->setTable('game_record_' . $tableSuf);
        $data = $game->where('id', '=', $id)->first();
        $data['creatime'] = date('Y-m-d H:i:s', $data['creatime']);
        $data['desk'] = $this->getDeskByDeskId($data['desk_id']);
        if ($data['type'] == 1) {
            $data['result'] = $this->getBaccaratParseJson($data['winner']);
        } else if ($data['type'] == 2) {
            $data['result'] = $this->getDragonTigerJson($data['winner']);
        } else if ($data['type'] == 3) {
            $data['result'] = $this->getFullParseJson($data['winner']);
        } else if ($data['type'] == 4) {

        } else {

        }
        //根据当前游戏记录的游戏类型 查询出游戏结果
        $data['gameResult'] = $this->getGameLabelArr($data['type']);
        return view('gameRecord.edit', ['info' => $data, 'id' => $id]);
    }

    /**
     * 获取所有台桌
     */
    public function getAllDesk()
    {
        return Desk::get();
    }

    /**
     * 修改龙虎的游戏结果
     * @param StoreRequest $request
     * @return array
     */
    public function updateDragonAndTigerResult(StoreRequest $request)
    {
        $id = $request->input('id');
        $tableName = $this->getGameRecordTableName($request->input('time'));
        $result = $request->input('result');
        $record = new GameRecord();
        $sql = $record->setTable('game_record_' . $tableName);
        //获取当前的数据信息
        $recordInfo = $sql->where('id', '=', $id)->first();
        $bootTime = strtotime(date('Ymd', $recordInfo['creatime']));
        //创建数组保存数据
        $data = array();
        $data['winner'] = $result;
        $data['update_result_before'] = $recordInfo['winner'];
        $data['update_time'] = time();
        $data['update_by'] = getLoginUser();
        $count = $sql->where('id', $id)->update($data);
        if ($count !== false) {
            insertDeskLogOperaResultType($recordInfo['desk_id'], $recordInfo['record_sn'], $recordInfo['boot_num'], $recordInfo['pave_num'], $bootTime, $recordInfo['winner'], $result);
            $lock = $this->redisLock($recordInfo['record_sn']);
            if($lock){
                $this->updateGameRecord($request->input('time'),$recordInfo);
                return ['msg' => '修改成功', 'status' => 1];
            }else{
                return ['msg' => '请忽频繁提交！', 'status' => 0];
            }
        } else {
            return ['msg' => '修改失败', 'status' => 0];
        }
    }

    /**
     * 修改百家乐的游戏结果
     * @param StoreRequest $request
     * @return array
     */
    public function updateBaccaratResult(StoreRequest $request)
    {
        $id = $request->input('id');
        //数据表名
        $tableName = $this->getGameRecordTableName($request->input('time'));
        $result = $request->input('result');
        $record = new GameRecord();
        $sql = $record->setTable('game_record_' . $tableName);
        //获取当前的数据信息
        $recordInfo = $sql->where('id', '=', $id)->first();
        $bootTime = strtotime(date('Ymd', $recordInfo['creatime']));
        //创建数组保存数据
        $data = array();
        $data['winner'] = $result;
        $data['update_result_before'] = $recordInfo['winner'];
        $data['update_time'] = time();
        $data['update_by'] = getLoginUser();
        $count = $sql->where('id', $id)->update($data);
        if ($count !== false) {
            insertDeskLogOperaResultType($recordInfo['desk_id'], $recordInfo['record_sn'], $recordInfo['boot_num'], $recordInfo['pave_num'], $bootTime, $recordInfo['winner'], $result);
            $lock = $this->redisLock($recordInfo['record_sn']);
            if($lock){
                $this->updateGameRecord($request->input('time'),$recordInfo);
                return ['msg' => '修改成功1', 'status' => 1];
            }else{
                return ['msg' => '请忽频繁提交！', 'status' => 0];
            }
        } else {
            return ['msg' => '修改失败', 'status' => 0];
        }
    }

    /**
     * 根据时间获取表名
     * @param $time
     * @return false|string
     */
    public function getGameRecordTableName($time)
    {
        $start = strtotime($time);
        return date("Ymd", $start);
    }

    /**
     * 获取游戏的结果集
     * @param $type
     * @return GameLabel[]|array|Collection
     */
    public function getGameLabelArr($type)
    {
        $data = array();
        //百家乐
        if ($type == 1) {
            //获取单选项
            $data['radio'] = GameLabel::where('game_type', '=', $type)->where('is_checkbox', '=', 1)->get();
            //获取多选
            $data['checkbox'] = GameLabel::where('game_type', '=', $type)->where('is_checkbox', '=', 0)->get();
        } else if ($type == 2) {//龙虎
            $data = GameLabel::where('game_type', '=', $type)->get();
        } else if ($type == 3) {//牛牛
            $data = GameLabel::where('game_type', '=', $type)->get();
        }
        return $data;
    }

    /**
     * 根据桌id查询出台桌名称跟游戏名称
     * @param $deskId
     * @return Desk|Desk[]|array|Collection|Model|null
     */
    public function getDeskByDeskId($deskId)
    {
        return $deskId ? Desk::find($deskId) : [];
    }

    /**
     * 解析百家乐的json数据
     * 根据游戏类型解析json数据
     * @param $jsonStr
     * @return array
     */
    public function getBaccaratParseJson($jsonStr)
    {
        $arr = array();
        //json格式数据
        //{"game":4,"playerPair":5,"bankerPair":2}
        $data = json_decode($jsonStr, true);
        if ($data['game'] == 1) {
            $arr['game'] = "和";
        } else if ($data['game'] == 4) {
            $arr['game'] = "闲";
        } else {
            $arr['game'] = "庄";
        }
        if (empty($data['playerPair'])) {
            $arr['playerPair'] = "";
        } else {
            $arr['playerPair'] = "闲对";
        }
        if (empty($data['bankerPair'])) {
            $arr['bankerPair'] = "";
        } else {
            $arr['bankerPair'] = "庄对";
        }
        return $arr;
    }

    /**
     * 判断龙虎结果
     * @param $winner
     * @return string
     */
    public function getDragonTigerJson($winner)
    {
        if ($winner == 7) {
            $result = "龙";
        } else if ($winner == 4) {
            $result = "虎";
        } else {
            $result = "和";
        }
        return $result;
    }

    /**
     * 解析牛牛的json数据
     * 根据游戏类型解析json数据
     * @param $jsonStr
     * @return array
     */
    public function getFullParseJson($jsonStr)
    {
        $arr = array();
        //解析json
        //{"bankernum":"牛1","x1num":"牛牛","x1result":"win","x2num":"牛2","x2result":"win","x3num":"牛3","x3result":"win"}
        $data = json_decode($jsonStr, true);
        //先判断庄是不是通吃
        if ($data['x1result'] == "" && $data['x2result'] == "" && $data['x3result'] == "") {
            $arr['bankernum'] = "庄";
        } else {
            $arr['bankernum'] = "";
        }
        if ($data['x1result'] == "win") {
            $arr['x1result'] = "闲1";
        } else {
            $arr['x1result'] = "";
        }
        if ($data['x2result'] == "win") {
            $arr['x2result'] = "闲2";
        } else {
            $arr['x2result'] = "";
        }
        if ($data['x3result'] == "win") {
            $arr['x3result'] = "闲3";
        } else {
            $arr['x4result'] = "";
        }
        return $arr;
    }

    /**
     * 效验密码
     * @param StoreRequest $request
     * @return array
     */
    public function checkUpdateResultPassword(StoreRequest $request)
    {
        //获取明文
        $password = $request->input('password');
        $pwd = md5(md5('123456'));
        if (md5(md5($password)) == $pwd) {
            return ['msg' => '效验成功', 'status' => 1];
        } else {
            return ['msg' => "密码错误", 'status' => 0];
        }
    }

    /**
     * 重新结算游戏
     * @param $creatime
     * @param $recordInfo
     */
    public function updateGameRecord($creatime,$recordInfo)
    {
        $bool = $this->ValidationTime($recordInfo);
        //获取表名
        $tableName = $this->getGameRecordTableName($creatime);
        $order = new Order();
        $order->setTable('order_'.$tableName);
        //根据游戏编号获取到用户下注记录
        $userOrderData = $order->where('record_sn','=',$recordInfo['record_sn'])->where("status",'=',1)->get();
        if ($bool==true){
            //获取明天的表名
            $tomorrow = $this->getTomorrowTableName($tableName);
            $order->setTable("order_".$tomorrow);
            //获取此局游戏下注记录
            $data = $order->where('record_sn','=',$recordInfo['record_sn'])->where("status",'=',1)->get();
            $userOrderData = array_merge($userOrderData,$data);
        }
        //开启事务
        DB::beginTransaction();
        //退钱
        $this->refundMoney($userOrderData);
        //判断游戏类型
        if ($recordInfo['type']==1){//百家乐
            $this->getBaccarat($recordInfo,$userOrderData);
            DB::commit();
        }else if ($recordInfo['type']==2){//龙虎
            $this->dragonAndTiger($recordInfo,$userOrderData);
            DB::commit();
        }else if ($recordInfo['type']==3){//牛牛
            $this->getNiuNiuSettlement($recordInfo,$userOrderData);
        }else if ($recordInfo['type']==4){//三公

        }else{ //A89

        }
        //解锁
        $this->unRedisLock($recordInfo['record_sn']);
    }

    /**
     * 根据表名 获取明天的表名
     * @param $tableName
     * @return false|int
     */
    public function getTomorrowTableName($tableName)
    {
        return strtotime("+1day",strtotime($tableName));
    }

    /**
     * 退钱
     * @param $userOrderData
     */
    public function refundMoney($userOrderData)
    {
        foreach ($userOrderData as $key=>$value){
            //获取用户帐变前的金额
            $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
            //判断get_money是否大于0.大于0则扣除 小于0添加
            if ($userOrderData[$key]['get_money']>0){
                $count = DB::table("user_account")->where('user_id',$userOrderData[$key]['user_id'])->decrement('balance',$userOrderData[$key]['get_money']);
                if ($count){
                    $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-$userOrderData[$key]['get_money'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果赢得扣输得添");
                    if ($num==0){
                        DB::rollback();
                    }
                }else{
                    DB::rollback();
                }
            }else{
               $count =  DB::table("user_account")->where('user_id',$userOrderData[$key]['user_id'])->increment('balance',abs($userOrderData[$key]['get_money']));
               if ($count){
                   $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                   $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],abs($userOrderData[$key]['get_money']),$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果赢得扣输得添");
                   if ($num==0){
                       DB::rollback();
                   }
               }else{
                   DB::rollback();
               }
            }
        }
    }

    /**
     * 获取当前用户的余额
     * @param $userId
     * @return mixed
     */
    public function getUserBalanceByUserId($userId)
    {
        $data = UserMoney::where('user_id',$userId)->first();
        return $data['balance'];
    }

    /**
     * 重新结算 龙虎 游戏
     * @param $recordInfo 当前游戏记录
     * @param $userOrderData 用户下注记录
     */
    public function dragonAndTiger($recordInfo,$userOrderData)
    {
        //{"dragon":2000,"tie":0,"tiger":0}
        //获取当前的游戏结果
        $result = $recordInfo['winner'];
        if ($result==7){//龙
            foreach ($userOrderData as $key=>$value){
                $json = $userOrderData[$key]['bet_money'];
                //把下注金额转json格式
                $arr = json_decode($json,true);
                //扣除不等于游戏结果的钱
                if ($arr['tie'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count =  DB::table("user_account")->where('user_id',$userOrderData[$key]['user_id'])->decrement('balance',(int)$arr['tie']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$arr['tie'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($arr['tiger'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->decrement('balance',(int)$arr['tiger']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$arr['tiger'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($arr['dragon'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count =  DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->increment('balance',($arr['dragon']/100 * 97));
                    if($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],((int)$arr['dragon'] * 0.97),$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }else if($result==4){//虎
            foreach ($userOrderData as $key=>$value){
                $json = $userOrderData[$key]['bet_money'];
                $arr = json_decode($json,true);
                if ($arr['dragon'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count =  DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->decrement('balance',(int)$arr['dragon']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$arr['dragon'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }
                }
                if ($arr['tie'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->decrement('balance',(int)$arr['tie']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$arr['tie'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }
                }
                if ($arr['tiger'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->increment('balance',((int)$arr['tiger'] * 0.97));
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],((int)$arr['tiger'] * 0.97),$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }else{//和
            foreach ($userOrderData as $key=>$value){
                $json = $userOrderData[$key]['bet_money'];
                $arr = json_decode($json,true);
                if ($arr['dragon']>0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count =  DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->increment('balance',(int)$arr['dragon']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],(int)$arr['dragon'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($arr['tiger'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->increment('balance',(int)$arr['tiger']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],(int)$arr['dragon'],$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($arr['tie'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = DB::table('user_account')->where('user_id',$userOrderData[$key]['user_id'])->increment('balance',((int)$arr['tie'] * 8));
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],((int)$arr['tie'] * 8),$before,$after,$userOrderData[$key]['game_type'],"修改游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }
    }
    /**
     * 效验 是否用连表查询
     * @param $recordInfo 游戏记录信息
     * @return bool
     */
    public function ValidationTime($recordInfo)
    {
        //获取游戏创建时间
        $createTime = $recordInfo['creatime'];
        //倒计时
        $countDown = $this->getDeskCountDownByDeskId($recordInfo['desk_id']);
        //获取第二天凌晨的时间戳
        $tomorrow = strtotime('+1day',strtotime(date('Y-m-d'),$createTime));
        //如果条件成立 返回true
        if ($createTime + $countDown > $tomorrow){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 根据台桌id获取到台桌的倒计时
     * @param $deskId
     * @return Desk|Desk[]|array|Collection|Model|null
     */
    public function getDeskCountDownByDeskId($deskId)
    {
        $data = $deskId?Desk::find($deskId):[];
        return $data['count_down'];
    }

    /**
     * 添加流水
     * @param $userId
     * @param $orderSn
     * @param $score
     * @param $betBefore
     * @param $betAfter
     * @param $gameType
     * @param $remark
     * @return bool
     */
    public function insertUserFlow($userId,$orderSn,$score,$betBefore,$betAfter,$gameType,$remark)
    {
        //获取今天的日期当表名
        $tableName = $this->getToDayDate();
        $bill = new Billflow();
        $bill->setTable('user_billflow_'.$tableName);
        $count = $bill->insert(['user_id'=>$userId,'order_sn'=>$orderSn,'score'=>$score,'bet_before'=>$betBefore,'bet_after'=>$betAfter,'status'=>4,'game_type'=>$gameType,'remark'=>$remark,'creatime'=>time()]);
        return $count;
    }

    /**
     * 获取今天的日期
     * @return false|string
     */
    public function getToDayDate(){
        return date('Ymd',time());
    }

    /**
     * 重新计算百家乐游戏结果
     * @param $recordInfo
     * @param $userOrderData
     */
    public function getBaccarat($recordInfo,$userOrderData){
        //{"game":4,"playerPair":5,"bankerPair":2}
        //获取结果
        $result = $recordInfo['winner'];
        $arr = json_decode($result,true);
        if ($arr['game']==7){//庄
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['banker'] > 0){ //庄赔率为0.95
                    //获取当前的金额
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->addUserBalacne($userOrderData[$key]['user_id'],($data['banker']/100 * 95));
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],((int)$data['banker']/100 * 95),$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                //扣钱
                if ($data['player'] > 0){//闲
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],$data['player']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-$data['player'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($data['tie'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],$data['tie']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-$data['tie'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }else if ($arr['game']==4){//闲
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['player'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->addUserBalacne($userOrderData[$key]['user_id'],(int)$data['player']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],(int)$data['player'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                //扣钱
                if ($data['banker'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],(int)$data['banker']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$data['banker'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($data['tie'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],(int)$data['tie']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$data['tie'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }else{//和
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['tie'] > 0){ //和 赔率 8 倍
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->addUserBalacne($userOrderData[$key]['user_id'],((int)$data['tie'] * 8));
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],((int)$data['tie'] * 8),$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                //扣钱
                if ($data['banker'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],(int)$data['banker']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$data['banker'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
                if ($data['player'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],(int)$data['player']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$data['player'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }
        //计算庄对闲对
        if (!empty($arr['playerPair'])){
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['playerPair'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->addUserBalacne($userOrderData[$key]['user_id'],($arr['playerPair'] * 11));
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],($arr['playerPair'] * 11),$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }else{
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['playerPair'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],(int)$data['playerPair']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$data['playerPair'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }
        if (!empty($arr['bankerPair'])){
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['bankerPair'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->addUserBalacne($userOrderData[$key]['user_id'],($data['bankerPair'] * 11));
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],($data['bankerPair'] * 11),$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }else{
            foreach ($userOrderData as $key=>$value){
                //{"banker":2000,"bankerPair":2000,"player":2000,"playerPair":2000,"tie":2000}
                $json = $userOrderData[$key]['bet_money'];
                $data = json_decode($json,true);
                if ($data['bankerPair'] > 0){
                    $before = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                    $count = $this->cutBackUserBalance($userOrderData[$key]['user_id'],(int)$data['bankerPair']);
                    if ($count){
                        $after = $this->getUserBalanceByUserId($userOrderData[$key]['user_id']);
                        $num = $this->insertUserFlow($userOrderData[$key]['user_id'],$userOrderData[$key]['order_sn'],-(int)$data['bankerPair'],$before,$after,$userOrderData[$key]['game_type'],"游戏结果重新计算");
                        if ($num==0){
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }
        }
    }

    /**
     * 重新计算牛牛的游戏结果
     * @param $recordInfo
     * @param $userOrderData
     */
    public function getNiuNiuSettlement($recordInfo,$userOrderData)
    {
        //{"bankernum":"牛1","x1num":"牛牛","x1result":"","x2num":"牛2","x2result":"","x3num":"牛3","x3result":""}
        //获取结果
        $result = $recordInfo['winner'];

    }

    /**
     * @param $userId
     * @param $money
     * @return mixed
     */
    public function cutBackUserBalance($userId,$money)
    {
        return DB::table("user_account")->where('user_id',$userId)->decrement('balance',$money);
    }

    /**
     * 添加余额
     * @param $userId
     * @param $money
     * @return mixed
     */
    public function addUserBalacne($userId,$money)
    {
        return DB::table("user_account")->where('user_id',$userId)->increment('balance',$money);
    }
}