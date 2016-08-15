<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Image extends CI_Migration {

    public function up()
    {
    	// 建立資料庫
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'panel' => array(
                'type' => 'INT',
                'comment' => '',
            ),
            'source_id' => array(
                'type' => 'INT',
                'null' => TRUE,
                'comment' => '對應ID',
            ),
            'file_timestamp' => array(
                'type' => 'INT',
                'comment' => '時間戳',
            ),
            'thumbnailUrl' => array(
                'type' => 'LONGTEXT',
                'comment' => '縮圖路徑',
                'null' => TRUE,
            ),
            'url' => array(
                'type' => 'LONGTEXT',
                'comment' => '大圖路徑',
            ),
            'deleteUrl' => array(
                'type' => 'LONGTEXT',
                'comment' => '刪除圖片路徑',
            ),
            'file_type' => array(
                'type' => 'VARCHAR',
                'comment' => '檔案類型',
            ),
            'file_name' => array(
                'type' => 'LONGTEXT',
                'comment' => '檔案名稱',
            ),
            'file_size' => array(
                'type' => 'INT',
                'comment' => '檔案大小',
            ),
            'file_number' => array(
                'type' => 'INT',
                'comment' => '欄位編號',
                'null' => TRUE,
            ),
            'recover' => array(
                'type' => 'INT',
                'default' => 0,
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'datetime',
                'comment' => '新增時間',
            ),
            'updated_at' => array(
                'type' => 'datetime',
                'comment' => '更新時間',
                'null' => TRUE,
            ),
            
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('image');
    }

    public function down()
    {
        $this->dbforge->drop_table('image');
    }
}