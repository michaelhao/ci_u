<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Users extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => 'Email',
            ),
            'account' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '帳號',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '密碼',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '姓名',
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '手機',
            ),
            'identity' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '身分證字號',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '地址',
            ),
            'birthday' => array(
                'type' => 'date',
                'comment' => '生日',
            ),
            'member_level' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '會員身分 0.普通 1.黃金',
            ),
            'verify' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '審核區 0.無 1.審核中',
            ),
            'verify_number' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '審核次數',
            ),
            'register_from' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '註冊來源',
            ),
            'gold' => array(
                'type' => 'INT',
                'default' => 0,
                'null' => TRUE,
                'comment' => '購物金',
            ),
            'bonus' => array(
                'type' => 'INT',
                'default' => 0,
                'null' => TRUE,
                'comment' => '紅利點',
            ),
            'bir_gift' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '生日禮 0.未開放 1.待兌換 2.已兌換',
            ),
            'isactive' => array(
                'type' => 'tinyint',
                'constraint' => 1,
                'default' => 0,
            ),
            'dt' => array(
                'type' => 'timestamp',
            ),
            'updated_at' => array(
                'type' => 'datetime',
                'comment' => '修改時間',
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}