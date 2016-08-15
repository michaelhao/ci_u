<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Order_detail extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'order_id' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
            ),
            'order_pid' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'order_size' => array(
                'type' => 'INT',
                'default' => 0,
            ),
            'order_pcount' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'order_name' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '產品名稱',
            ),
            'order_pname' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'comment' => '產品名稱',
            ),
            'order_psubtotal' => array(
                'type' => 'INT',
                'comment' => '產品單價',
            ),
            'order_otherinfo' => array(
                'type' => 'text',
                'null' => TRUE,
            ),
            'recover' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '資料狀態:0.正常 1.刪除',
            ),
            'created_at' => array(
                'type' => 'datetime',
            ),
            'updated_at' => array(
                'type' => 'datetime',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('order_detail');

    }

    public function down()
    {
        $this->dbforge->drop_table('order_detail');
    }
}