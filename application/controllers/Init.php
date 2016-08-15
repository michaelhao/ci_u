<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Init extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     if(ENVIRONMENT != "development") {
    //         echo '請勿再正式環境下執行 Migrate!!';
    //     } else {
    //         $this->load->library('migration');
    //     }   
    // }

    public function index()
    {
        // 驗證環境
        if(ENVIRONMENT != "production") {
            echo 'Error:環境不是 Production<BR>';
        } else {
            echo 'Success:環境是 Production<BR>';
        }

        // PHP 版本
        if (version_compare(PHP_VERSION, '5.4', '!=')) {
            echo 'Error:PHP 版本不正確'.PHP_VERSION.'<BR>';
        } else {
            echo 'Success:PHP 版本正確<BR>';
        }

        // if ($this->migration->current() === FALSE)
        // {
        //     show_error($this->migration->error_string());
        // } else {
        // 	echo $this->migration->current();
        // }
    }
}


