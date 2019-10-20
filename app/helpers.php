<?php
use Illuminate\Support\Facades\DB;
function getDeviceName($id){
    $device = DB::table('device_name')->find($id);
    if($device){
        return $device->name;
    }
    return 'Thiết bị không xác định';
}

function getTargetName($id){
    $target = DB::table('target_use')->find($id);
    if($target){
        return $target->name;
    }
    return 'Mục đích sử dụng không xác định';
}
