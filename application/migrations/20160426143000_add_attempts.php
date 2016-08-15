<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Attempts extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'ip' => array(
                'type' => 'VARCHAR',
            ),
            'expiredate' => array(
                'type' => 'datetime',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('attempts');

    }

    public function down()
    {
        $this->dbforge->drop_table('attempts');
    }
}