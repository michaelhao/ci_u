<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Product extends CI_Migration {

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
            'type' => array(
                'type' => 'INT',
                'comment' => '類別',
                'null' => TRUE,
            ),
            'number' => array(
                'type' => 'INT',
                'comment' => '商品編號',
            ),
            'kind' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '商品品項 1.電商 2.實體 3.皆有',
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
            'pay_method' => array(
                'type' => 'VARCHAR',
                'comment' => '付款方式',
                'null' => TRUE,
            ),
            'transport_method' => array(
                'type' => 'VARCHAR',
                'comment' => '交貨方式',
                'null' => TRUE,
            ),
            'visitor' => array(
                'type' => 'INT',
                'comment' => '瀏覽人數',
                'default' => 0,
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
            'show' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '上架:1.顯示 2.隱藏',
            ),
            'hot' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '資料狀態:0.一般商品 1.熱門商品',
            ),
            'price' => array(
                'type' => 'LONGTEXT',
                'comment' => '定價',
                'null' => TRUE,
            ),
            'special_offer' => array(
                'type' => 'LONGTEXT',
                'comment' => '特價',
                'null' => TRUE,
            ),
            'qty' => array(
                'type' => 'LONGTEXT',
                'comment' => '庫存',
                'null' => TRUE,
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product');

        // 基礎資料
        // $insert_sql = "";
        // $query = $this->db->query($insert_sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('product');
    }
}