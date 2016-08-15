<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Admintable extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'comment' => '管理者名稱',
            ),
            'acc' => array(
                'type' => 'VARCHAR',
                'comment' => '帳號',
            ),
            'pwd' => array(
                'type' => 'VARCHAR',
                'comment' => '密碼',
            ),
            'pic' => array(
                'type' => 'VARCHAR',
                'comment' => '大頭照',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'comment' => 'email',
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'comment' => '職稱',
            ),
            'time' => array(
                'type' => 'date',
                'comment' => '建立時間',
            ),
            'right' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '權限狀態:1.啟用 0.停權',
            ),
            'Recover' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '資料狀態:0.正常 1.刪除',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('admintable');

    }

    public function down()
    {
        $this->dbforge->drop_table('admintable');
    }
}