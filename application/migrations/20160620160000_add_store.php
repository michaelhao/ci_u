<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Store extends CI_Migration {

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
                'comment' => '功能項',
            ),
            'lang' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '語系',
            ),
            'type' => array(
                'type' => 'INT',
                'comment' => '類別',
                'null' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'comment' => '標題',
                'null' => TRUE,
            ),
            'pic' => array(
                'type' => 'LONGTEXT',
                'comment' => '主圖',
                'null' => TRUE,
            ),
            'pic2' => array(
                'type' => 'LONGTEXT',
                'comment' => '副圖',
                'null' => TRUE,
            ),
            'pic3' => array(
                'type' => 'LONGTEXT',
                'comment' => '副圖',
                'null' => TRUE,
            ),
            'pic4' => array(
                'type' => 'LONGTEXT',
                'comment' => '副圖',
                'null' => TRUE,
            ),
            'pic5' => array(
                'type' => 'LONGTEXT',
                'comment' => '副圖',
                'null' => TRUE,
            ),
            'pic6' => array(
                'type' => 'LONGTEXT',
                'comment' => '副圖',
                'null' => TRUE,
            ),
            'description' => array(
                'type' => 'LONGTEXT',
                'comment' => '簡述',
                'null' => TRUE,
            ),
            'content' => array(
                'type' => 'LONGTEXT',
                'comment' => '文章內容',
                'null' => TRUE,
            ),
            'start_at' => array(
                'type' => 'datetime',
                'comment' => '上刊時間',
                'null' => TRUE,
            ),
            'end_at' => array(
                'type' => 'datetime',
                'comment' => '下刊時間',
                'null' => TRUE,
            ),
            'show' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '顯示:1.顯示 2.隱藏',
            ),
            'created_at' => array(
                'type' => 'datetime',
                'comment' => '新增時間',
            ),
            'updated_at' => array(
                'type' => 'datetime',
                'comment' => '修改時間',
            ),
            'recover' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '資料狀態:0.正常 1.刪除',
            ),
            'sort' => array(
                'type' => 'INT',
                'comment' => '排序',
            ),
            'field1' => array(
                'type' => 'LONGTEXT',
                'comment' => '客製化欄位',
                'null' => TRUE,
            ),
            'field2' => array(
                'type' => 'LONGTEXT',
                'comment' => '客製化欄位',
                'null' => TRUE,
            ),
            'field3' => array(
                'type' => 'LONGTEXT',
                'comment' => '客製化欄位',
                'null' => TRUE,
            ),
            'field4' => array(
                'type' => 'LONGTEXT',
                'comment' => '客製化欄位',
                'null' => TRUE,
            ),
            'field5' => array(
                'type' => 'LONGTEXT',
                'comment' => '客製化欄位',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('store');
    }

    public function down()
    {
        $this->dbforge->drop_table('store');
    }
}