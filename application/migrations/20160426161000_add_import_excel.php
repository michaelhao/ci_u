<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Import_excel extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'number' => array(
                'type' => 'INT',
                'comment' => '編號',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'comment' => '產品名稱',
            ),
            'content' => array(
                'type' => 'LONGTEXT',
                'comment' => '產品詳述',
            ),
            'description' => array(
                'type' => 'LONGTEXT',
                'comment' => '簡述',
            ),
            'price' => array(
                'type' => 'LONGTEXT',
                'comment' => '價格',
            ),
            'special_offer' => array(
                'type' => 'LONGTEXT',
                'comment' => '特價',
            ),
            'pic' => array(
                'type' => 'LONGTEXT',
                'comment' => '商品圖片',
            ),
            'qty' => array(
                'type' => 'LONGTEXT',
                'comment' => '庫存',
            ),
            'type_main' => array(
                'type' => 'VARCHAR',
                'comment' => '主分類',
            ),
            'type_minor' => array(
                'type' => 'VARCHAR',
                'comment' => '次分類',
            ),
            'type_detail' => array(
                'type' => 'VARCHAR',
                'comment' => '細分類',
            ),
            'color' => array(
                'type' => 'LONGTEXT',
                'comment' => '規格顏色',
            ),
            'timestamp' => array(
                'type' => 'INT',
                'comment' => '檔案匯入時間',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'datetime',
                'comment' => '新增時間',
            ),
            'updated_at' => array(
                'type' => 'datetime',
                'comment' => '修改時間',
                'null' => TRUE,
            ),
            'recover' => array(
                'type' => 'INT',
                'comment' => '顯示',
            ),
            'sort' => array(
                'type' => 'INT',
                'comment' => '排序',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('import_excel');

    }

    public function down()
    {
        $this->dbforge->drop_table('import_excel');
    }
}