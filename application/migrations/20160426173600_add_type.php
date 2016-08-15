<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Type extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'panel' => array(
                'type' => 'INT',
            ),
            'parent_id' => array(
                'type' => 'INT',
                'comment' => '上層 ID',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'comment' => '中文類別名稱',
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'comment' => '英文類別名稱',
            ),
            'created_at' => array(
                'type' => 'datetime',
            ),
            'updated_at' => array(
                'type' => 'datetime',
            ),
            'sort' => array(
                'type' => 'INT',
                'comment' => '排序',
            ),
            'recover' => array(
                'type' => 'INT',
                'default' => 0,
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('type');

    }

    public function down()
    {
        $this->dbforge->drop_table('type');
    }
}