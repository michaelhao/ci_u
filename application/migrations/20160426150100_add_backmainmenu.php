<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Backmainmenu extends CI_Migration {

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
                'comment' => '選單名稱',
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'comment' => '功能列表連結',
            ),
            'listpage' => array(
                'type' => 'VARCHAR',
                'comment' => '列表頁面路徑',
            ),
            'insertpage' => array(
                'type' => 'VARCHAR',
                'comment' => '新增頁面路徑',
            ),
            'modifypage' => array(
                'type' => 'VARCHAR',
                'comment' => '修改頁面路徑',
            ),
            'recoverpage' => array(
                'type' => 'VARCHAR',
                'comment' => '回收桶頁面路徑',
            ),
            'typepage' => array(
                'type' => 'VARCHAR',
                'comment' => '類別頁面路徑',
            ),
            'showhide' => array(
                'type' => 'INT',
                'default' => 1,
                'null' => TRUE,
            ),
            'admintype1_permission' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '管理者檢視權限',
            ),
            'admintype2_permission' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '管理者檢視權限',
            ),
            'admintype3_permission' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '管理者檢視權限',
            ),
            'sort' => array(
                'type' => 'INT',
                'comment' => '選單排序',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('backmainmenu');

    }

    public function down()
    {
        $this->dbforge->drop_table('backmainmenu');
    }
}