<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Services extends CI_Migration {

    public function up()
    {
        // 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'type' => array(
                'type' => 'INT',
                'comment' => '類別 1.商品問與答 2.會員悄悄話',
                'null' => TRUE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'comment' => '使用者ID',
                'null' => TRUE,
            ),
            'product_id' => array(
                'type' => 'INT',
                'comment' => '商品ID',
                'null' => TRUE,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'comment' => '標題',
            ),
            'content' => array(
                'type' => 'LONGTEXT',
                'comment' => '客戶留言內容',
            ),
            'content2' => array(
                'type' => 'LONGTEXT',
                'comment' => '客服回覆內容',
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
            'update' => array(
                'type' => 'INT',
                'comment' => '更新者',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('services');

    }

    public function down()
    {
        $this->dbforge->drop_table('services');
    }
}