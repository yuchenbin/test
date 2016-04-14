<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonFunc
{

    /**
     * 显示调试信息
     *
     * @param fixed $evt
     */
    public static function ecall($evt)
    {

        echo '<pre>';

        if (is_array($evt))
        {
            echo '数组输出：<br>';
            print_r($evt);
        }
        else
        {
            echo '字符串输出：<br>' . $evt;
        }
        die;
    }
}
