<?php
/**
 * Created by PhpStorm.
 * User: David Pratt Jr
 * Date: 7/5/2020
 * Time: 7:16 PM
 */


namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;

interface ILogger {
    public static function getLogger();
    public static function debug($message);
    public static function info($message);
    public static function warning($message);
    public static function error($message);
}

class Logger implements ILogger
{
    public static function getLogger() {}



    public static function debug($message) {
        Log::debug($message);
    }



    public static function info($message) {
        Log::info($message);
    }


    public static function warning($message) {
        Log::warning($message);
    }



    public static function error($message) {
        Log::error($message);
    }
}