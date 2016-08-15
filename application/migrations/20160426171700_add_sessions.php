<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Sessions extends CI_Migration {

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
            'hash' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
            ),
            'expiredate' => array(
                'type' => 'datetime',
            ),
            'ip' => array(
                'type' => 'VARCHAR',
            ),
            'agent' => array(
                'type' => 'VARCHAR',
            ),
            'cookie_crc' => array(
                'type' => 'VARCHAR',
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sessions');

    }

    public function down()
    {
        $this->dbforge->drop_table('sessions');
    }
}