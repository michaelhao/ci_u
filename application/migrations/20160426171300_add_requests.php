<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Requests extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'uid' => array(
                'type' => 'INT',
            ),
            'rkey' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
            ),
            'expire' => array(
                'type' => 'datetime',
            ),
            'type' => array(
                'type' => 'VARCHAR',
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('requests');

    }

    public function down()
    {
        $this->dbforge->drop_table('requests');
    }
}