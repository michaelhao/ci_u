<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Order extends CI_Migration {

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
                'comment' => '',
            ),
            'order_uid' => array(
                'type' => 'INT',
                'comment' => '',
            ),
            'order_payclass' => array(
                'type' => 'text',
                'comment' => '支付方式',
            ),
            'order_status' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '付款狀態 1.未付款 2.已付款',
           ),
           'status' => array(
                'type' => 'INT',
                'default' => 1,
                'comment' => '訂單狀態 1.待處理 2.已出貨 3.訂單註銷',
             ),            
            'order_postname' => array(
                'type' => 'text',
                'comment' => '收件者',
            ),
            'order_postsex' => array(
                'type' => 'INT',
                'comment' => '性別 1.男 2.女 3.無',
                'default' => 3
            ),
            'order_postclass' => array(
                'type' => 'INT',
                'comment' => '收件類型',
            ),
            'order_shop' => array(
                'type' => 'INT',
                'comment' => '購物車編號',
            ),
            'order_total' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '訂單金額',
            ),
            'order_redeem' => array(
                'type' => 'INT',
                'default' => 0,
                'comment' => '購物金折抵金額',
            ),
            'order_postcharges' => array(
                'type' => 'INT',
                'default' => 0,
            ),
            'order_postzipcode' => array(
                'type' => 'VARCHAR',
                'comment' => '收件郵遞區號',
            ),
            'order_postaddr' => array(
                'type' => 'text',
                'comment' => '收件地址',
            ),
            'order_postphone' => array(
                'type' => 'VARCHAR',
                'comment' => '收件電話',
            ),
            'order_posttel' => array(
                'type' => 'VARCHAR',
                'comment' => '室內電話',
            ),
            'order_postdate' => array(
                'type' => 'datetime',
            ),
            'receive_day' => array(
                'type' => 'date',
                'comment' => '收件日期',
            ),
            'receive_time' => array(
                'type' => 'INT',
                'comment' => '收件時段 0.不指定 1.上午 2.下午 3.晚上 ',
            ),
            'note' => array(
                'type' => 'text',
                'comment' => '備註',
            ),
            'store_from' => array(
                'type' => 'VARCHAR',
                'default' => 0,
                'comment' => '下單分店',
            ),
            'store_clerk' => array(
                'type' => 'VARCHAR',
                'default' => 0,
                'comment' => '下單店員',
            ),
            // 'invoice_donate' => array(
            //     'type' => 'INT',
            //     'default' => 0,
            //     'comment' => '捐發票 0.否 1.是',
            // ),
            // 'invoice_type' => array(
            //     'type' => 'INT',
            //     'default' => 1,
            //     'comment' => '發票形式 1. 不開發票 2.二聯式 3.三聯式',
            // ),
            // 'invoice_title' => array(
            //     'type' => 'VARCHAR',
            //     'null' => TRUE,
            //     'comment' => '發票抬頭',
            // ),
            // 'invoice_Unumber' => array(
            //     'type' => 'VARCHAR',
            //     'null' => TRUE,
            //     'comment' => '發票統編',
            // ),
            'post_data' => array(
                'type' => 'text',
                'comment' => 'POST DATA',
                'null' => TRUE,
            ),
            'order_posttime' => array(
                'type' => 'INT',
            ),
            'order_paytime' => array(
                'type' => 'datetime',
                'comment' => '付款時間',
            ),
            'created_at' => array(
                'type' => 'datetime',
                'comment' => '建立時間',
            ),
            'updated_at' => array(
                'type' => 'datetime',
                'comment' => '修改時間',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('order');

    }

    public function down()
    {
        $this->dbforge->drop_table('order');
    }
}