<?php

$str = '["1","2","3"]';

$data = json_decode($str,true);
print_r($data);
foreach ($data as $k=>$v){
    var_dump($v);
}