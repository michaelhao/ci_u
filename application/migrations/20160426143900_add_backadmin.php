<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_backadmin extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'webname' => array(
                'type' => 'VARCHAR',
                'comment' => '網站名稱',
            ),
            'webtitle' => array(
                'type' => 'VARCHAR',
                'comment' => '網站標題',
            ),
            'keyword' => array(
                'type' => 'VARCHAR',
                'comment' => '關鍵字',
                'null' => TRUE,
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'comment' => '',
                'null' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'comment' => 'email',
                'null' => TRUE,
            ),
            'copyright' => array(
                'type' => 'VARCHAR',
                'comment' => '版權',
            ),
            'tel' => array(
                'type' => 'VARCHAR',
                'comment' => '電話',
                'null' => TRUE,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'comment' => '地址',
            ),
            'shipment' => array(
                'type' => 'VARCHAR',
                'comment' => '運費',
                'default' => 0,
                'null' => TRUE,
            ),
            'discount_shipment' => array(
                'type' => 'VARCHAR',
                'comment' => '滿額運費',
                'default' => 0,
                'null' => TRUE,
            ),
            'discount_money' => array(
                'type' => 'VARCHAR',
                'comment' => '運費滿額標準',
                'default' => 0,
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('backadmin');
    }

    public function down()
    {
        $this->dbforge->drop_table('backadmin');
    }
}