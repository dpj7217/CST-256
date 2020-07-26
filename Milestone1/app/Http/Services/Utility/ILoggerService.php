<?php
namespace App\Services\Utility;

interface ILoggerService {
    public function debug($message);
    public function info($message);
    public function warning($message);
    public function error($message);
}
