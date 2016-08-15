<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Static extends CI_Migration {

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
            'updated_at' => array(
                'type' => 'datetime',
                'comment' => '修改時間',
            ),
            'show' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '顯示:1.顯示 0.隱藏',
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
        $this->dbforge->create_table('static');

    }

    public function down()
    {
        $this->dbforge->drop_table('static');
    }
}