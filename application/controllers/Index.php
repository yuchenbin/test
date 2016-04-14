<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends OASController
{

    public function __construct()
    {
        parent::__construct();
    }
    public function  index()
    {
    $this->display('hello');
    }
}