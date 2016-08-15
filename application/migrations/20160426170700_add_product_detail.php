<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Product_detail extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'product_id' => array(
                'type' => 'INT',
                'comment' => '功能項',
            ),
            'spec' => array(
                'type' => 'VARCHAR',
                'comment' => '規格',
                'null' => TRUE,
            ),
            'qty' => array(
                'type' => 'LONGTEXT',
                'comment' => '庫存',
                'null' => TRUE,
            ),
            'color' => array(
                'type' => 'LONGTEXT',
                'comment' => '類別',
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
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product_detail');

    }

    public function down()
    {
        $this->dbforge->drop_table('product_detail');
    }
}