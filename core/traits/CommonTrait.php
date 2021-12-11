<?php

namespace Core\Traits;

trait CommonTrait
{
    public function view($view)
    {
        $exploded = array_filter(explode('.', $view));
        $imploded = implode('/', $exploded);
        return VIEW_DIR."/$imploded.php";
    }

    public function log($data)
    {
        $data['client_ip'] = getenv('HTTP_CLIENT_IP')?:
            getenv('HTTP_X_FORWARDED_FOR')?:
            getenv('HTTP_X_FORWARDED')?:
            getenv('HTTP_FORWARDED_FOR')?:
            getenv('HTTP_FORWARDED')?:
            getenv('REMOTE_ADDR');
        $data['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
        $file = LOG_DIR."/log-".date('d-m-Y').".log";
        $content = "[".date('Y-m-d H:i:s')."] ".json_encode($data).PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND);
    }
}
