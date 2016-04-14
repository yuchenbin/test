<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-13
 * Time: 下午3:22
 */
defined('BASEPATH') or die('Access restricted!');

require(APPPATH . 'third_party/smarty/Smarty.class.php');

class CISmarty extends Smarty
{

    public function __construct($template_dir = '', $compile_dir = '', $config_dir = '', $cache_dir = '')
    {
        parent::__construct();
        if (is_array($template_dir))
        {
            foreach ($template_dir as $key => $value)
            {
                $this->$key = $value;
            }
        }
        else
        {
            //ROOT是Codeigniter在入口文件index.php定义的本web应用的根目录
            $this->template_dir = $template_dir ? $template_dir : VIEWS . '/';
            $this->compile_dir  = $compile_dir ? $compile_dir : CACHE . '/templates_c';
        }
    }
}