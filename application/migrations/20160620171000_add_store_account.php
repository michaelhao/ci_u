<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Store_account extends CI_Migration {

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
                'comment' => '使用者名稱',
            ),
            'acc' => array(
                'type' => 'VARCHAR',
                'comment' => '帳號',
            ),
            'pwd' => array(
                'type' => 'VARCHAR',
                'comment' => '密碼',
            ),
            'store' => array(
                'type' => 'VARCHAR',
                'comment' => '分店',
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'comment' => 'TOKEN',
                'default' => '1qazxsw2',
                'null' => TRUE,
            ),
            'login_time' => array(
                'type' => 'datetime',
                'comment' => '最後登入時間',
                'null' => TRUE,
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
        $this->dbforge->create_table('store_account');

    }

    public function down()
    {
        $this->dbforge->drop_table('store_account');
    }
}