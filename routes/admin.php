<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//验证码
Route::get('/verify',                   'Admin\HomeController@verify');
//登陆模块
Route::group(['namespace'  => "Auth"], function () {
    Route::get('/register',             'BindController@index');    //绑定谷歌验证码
    Route::post('/valAccount',          'BindController@checkAccount'); //效验账号是否存在
    Route::post('/valUser',             'BindController@checkUserLogin');//效验账号密码的真实性
    Route::post('/sendSMS',             'BindController@sendSMS');//发送验证码
    Route::post('/bindCode',            'BindController@bindCode');//绑定加效验
    Route::get('/login',                'LoginController@showLoginForm')->name('login');//登录
    Route::post('/login',               'LoginController@login');
    Route::get('/logout',               'LoginController@logout')->name('logout');
});
//后台主要模块
Route::group(['namespace' => "Admin",'middleware' => ['auth', 'permission']], function () {
    Route::get('/',                     'HomeController@index');
    Route::get('/gewt',                 'HomeController@configr');
    Route::get('/index',                'HomeController@welcome');
    Route::post('/sort',                'HomeController@changeSort');
    Route::resource('/menus',           'MenuController');
    Route::resource('/logs',            'LogController');
    Route::resource('/users',           'UserController');
    Route::resource('/ucenter',         'UcenterController');
    Route::get('/userinfo',             'UserController@userInfo');
    Route::post('/saveinfo/{type}',     'UserController@saveInfo');
    Route::resource('/roles',           'RoleController');
    Route::resource('/permissions',     'PermissionController');
    //台桌管理
    Route::resource("/desk",            'DeskController');
    Route::post('/changStatus',         'DeskController@changStatus');//台桌停用
    Route::post('/closeVideo',          'DeskController@closeVideo');//关视频
    Route::post('/resetPassword',       'DeskController@resetPassword');//重置台桌密码
    //游戏类型
    Route::resource('/game',            'GameController');
    Route::post('/gameUpdate',      'GameController@update');
    //游戏用户管理
    Route::resource('/userAccount', 'UserAccountController');
    //富文本编辑器文件上传
    Route::post('/uploadFile','UploadFileController@uploadFile');
    //修改台桌
    Route::post('/deskUpdate','DeskController@update');
    //台桌结果
    Route::resource('/gameRecord',      'GameRecordController');
    //修改游戏结果的密码效验
    Route::post('/checkUpdateResultPassword','GameRecordController@checkUpdateResultPassword');
    Route::post('/updateDragonAndTigerResult','GameRecordController@updateDragonAndTigerResult');//修改龙虎游戏结果
    Route::post('/updateBaccaratResult',    'GameRecordController@updateBaccaratResult');//修改百家乐游戏结果
    Route::get('/edit','GameRecordController@edit');
    Route::post('/resetPwd',        'UserAccountController@resetPwd');//修改密码
    Route::post('/isLogin',         'UserAccountController@isLogin');//封禁
    Route::resource('/options',         'OptionController');//系统设置-缓存设置
    Route::post('/optionsUpdate',       'OptionController@update');
    Route::resource('/version',         'VersionController');//系统设置-版本控制
    Route::post('/versionUpdate',       'VersionController@update');
    Route::post('/version_isopen',      'VersionController@is_open');//开关
    Route::resource('/notices',          'NoticeController');//公告
    Route::resource('/orderlist',       'OrderlistController');//订单列表

    Route::resource('/label',           'GameLabelController');//结果标签
    Route::resource('/stopDesk',        'StopDeskController'); //停用台桌列表

    Route::resource('/anchor',          'AnchorController'); //主播账号列表
    Route::post('/anchor/changeStatus', 'AnchorController@changeStatus');//账号停用/启用
    Route::post('/anchorUpdate',     'AnchorController@update'); //主播账号编辑

    Route::resource('/deskLog',         'DeskLogController'); //台桌操作日志
    Route::resource('/deskResultLog',   'DeskUpdateResultController');//台桌修改结果日志
    Route::resource('/ipBlacklist',     'IpBlacklistController');    //ip黑名单
    Route::post('/updateIp',            'IpBlacklistController@update');  //修改封禁ip
    Route::post('/checkUniqueIp',       'IpBlacklsaveinfoistController@checkUniqueIp');   //效验ip是否存在
    Route::resource('/pay',             'PayController'); //第三方支付设置
    Route::resource('/camera',          'CameraController');//摄像头管理展示
    Route::post('/camera/update',      'CameraController@update');
    Route::resource('/webnotice',        'WebNoticeController');//web轮播公告
    Route::resource('/gamenotice',       'GameNoticeController');//游戏轮播公告
    Route::resource('/entrance',         'EntranceNoticeController');//入口公告
    Route::resource('/system',           'SystemController');//系统开关
    Route::post('/maintain',             'SystemController@maintain');//点击系统维护
    Route::post('/drawOpen',            'SystemController@drawOpen');//提现开关


    Route::resource('/agent','AgentUserController');//代理列表
    Route::post('/agentUpdate',       'AgentUserController@update');//代理账号编辑

    Route::resource('/agentRole',       'AgentRoleController');//代理角色管理
    Route::resource('/agentBlack',      'AgentBlackController');//代理黑名单
    Route::resource('/userBlack',       'UserBlackController');//会员黑名单
    Route::resource('/forbidden',       'ForbiddenController');//禁言名单
    Route::resource('/userDesk',        'UserDeskController');//特定用户限红
    Route::post('/userDesk/update',     'UserDeskController@update');//修改

    //代理模块路由
    Route::group(['namespace'=>'Agent','middleware' => ['auth', 'permission']],function(){
        Route::resource('/agent','AgentUserController');//代理列表
        Route::post('/agentUpdate',       'AgentUserController@update');//代理账号编辑

        Route::resource('/agentRole','AgentRoleController');//代理角色
        Route::resource('/agentMenu','AgentMenuController');
        Route::post('/agentRole/update','AgentRoleController@update');

    });
});

Route::get('/phpinfo',function (Request $request){
   phpinfo();
});