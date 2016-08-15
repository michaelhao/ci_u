<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Shopping_cart extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'cart_uid' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '使用者ID',
            ),
            'cart_shopper' => array(
                'type' => 'VARCHAR',
                'comment' => 'shopper id',
            ),
            'cart_pid' => array(
                'type' => 'VARCHAR',
                'comment' => '商品ID',
            ),
            'cart_pname' => array(
                'type' => 'VARCHAR',
            ),
            'cart_postclass' => array(
                'type' => 'INT',
                'comment' => '商品類別',
            ),
            'cart_otherinfo' => array(
                'type' => 'text',
                'null' => TRUE,
            ),
            'cart_count' => array(
                'type' => 'INT',
            ),
            'cart_price' => array(
                'type' => 'INT',
                'comment' => '商品價格',
            ),
            'cart_size' => array(
                'type' => 'INT',
                'default' => 0,
                'null' => TRUE,
            ),
            'cart_status' => array(
                'type' => 'INT',
                'default' => 0,
            ),
            'created_at' => array(
                'type' => 'datetime',
            ),
            'updated_at' => array(
                'type' => 'datetime',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('shopping_cart');

    }

    public function down()
    {
        $this->dbforge->drop_table('shopping_cart');
    }
}