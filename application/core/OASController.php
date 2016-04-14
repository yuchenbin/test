<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OASController extends CI_Controller
{
    public $smarty;

    public function __construct()
    {
        global $_custom_smarty_config;

        parent::__construct();

        // 载入smarty 配置
        $this->load->library('CISmarty');
        if (!empty($_custom_smarty_config))
        {
            foreach ($_custom_smarty_config as $key => $val)
            {
                $this->cismarty->$key = $val;
            }
        }
        $this->smarty = $this->cismarty;
    }

    /**
     * 给变量赋值
     *
     * @param $key
     * @param $val
     */
    public function assign($key, $val)
    {
        $this->smarty->assign($key, $val);
    }

    /**
     * 显示到模版
     *
     * @param $html
     */
    public function display($html)
    {
        $this->smarty->display($html);
    }

    /**
     * Fetch an item from the GET array
     *
     * @param    mixed $index     Index for item to be fetched from $_GET
     * @param    bool  $xss_clean Whether to apply XSS filtering
     *
     * @return    mixed
     */
    public function get($index = null, $xss_clean = null)
    {
        return $this->input->get($index, $xss_clean);
    }

    /**
     * Fetch an item from the Post array
     *
     * @param    mixed $index     Index for item to be fetched from $_GET
     * @param    bool  $xss_clean Whether to apply XSS filtering
     *
     * @return    mixed
     */
    public function post($index = null, $xss_clean = null)
    {
        return $ret = $this->input->post($index, $xss_clean);
    }

    /**
     *
     * 检测年月的格式
     *
     * @param $date
     *
     * @return array|bool
     */
    public function checkYearMonth($date)
    {
        if (!preg_match('/^[0-9]{4}-[0-9]{2}$/', $date))
        {
            $ret = array(
                'error_code' => 1005,
                'error_msg'  => '时间格式不正确'
            );

            return $ret;
        }

        return true;
    }

    public function checkEmptyParam($paramVal)
    {
        if (!isset($paramVal) || empty($paramVal))
        {
            return false;
        }

        return true;
    }

    public function showError($mes)
    {
        header('Content-type:text/html;charset=utf-8');
        echo '<script>alert("' . $mes . '");</script>';
    }

    /**
     * 清空数组中的空值
     *
     * @param       $arr
     * @param array $arrNotCheckFields
     */
    public function clearEmptyValue(&$arr, $arrNotCheckFields = array())
    {
        foreach ($arr as $k => $v)
        {
            if (empty($v)
                && strcmp($v, '0') !== 0
                && !in_array($k, $arrNotCheckFields)
            )
            {
                unset($arr[$k]);
            }
        }
    }

    /**
     * 判断是不是数字
     *
     * @param $data
     *
     * @return bool
     */
    public function checkNumber($data)
    {
        return is_numeric($data);
    }

    /**
     * 获得url参数
     * @return string
     */
    public function getUrl()
    {
        $url = $this->getHost();
        $url .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        return $url;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        if (isset($_SERVER['HTTP_X_HOST']))
        {
            $arr = explode(':', $_SERVER['HTTP_X_HOST']);
            if (isset($arr[1]) && '80' !== $arr[1])
            {
                $host = $_SERVER['HTTP_X_HOST'];
            }
            else
            {
                $host = $arr[0];
            }
        }
        else
        {
            $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ?
                $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER['SERVER_PORT']));
        }

        return $host;
    }

    /**
     * 输出
     *
     * @param        $data
     * @param string $type
     */
    public function outPut($data, $type = 'json')
    {
        if (strcmp($type, 'json') === 0)
        {
            exit(json_encode($data));
        }
    }
}