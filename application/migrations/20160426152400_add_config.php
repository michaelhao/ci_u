<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Config extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'setting' => array(
                'type' => 'VARCHAR',
                'unique' => TRUE,
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
            ),
        ));
        // $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('config');
    }

    public function down()
    {
        $this->dbforge->drop_table('config');
    }
}