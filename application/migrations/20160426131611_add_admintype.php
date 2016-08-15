<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Admintype extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('admintype');
    }

    public function down()
    {
        $this->dbforge->drop_table('admintype');
    }
}