<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class BaseModel extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    //USER STATUS
    const USER_LOCKED = 0;
    const USER_ACTIVE = 1;

    //ALERT TYPE
    const ALERT_SUCCESS = 'success';
    const ALERT_FAIL = 'fail';
    const ALERT_WARNING = 'warning';
    const ALERT_DANGER = 'danger';
    const ALERT_INFO = 'info';
    const ALERT_ARRAY = [self::ALERT_SUCCESS, self::ALERT_FAIL, self::ALERT_WARNING, self::ALERT_DANGER, self::ALERT_INFO];
}
