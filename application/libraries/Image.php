<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image
{
    public $typearray = array();
    public $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }
    
    // 抓取圖片相對路徑-單圖
    public function getImage($datas, $path = 'assert/files/files/', $file_number = 0)
    {
        if($path == '')
            $path = 'assert/files/files/';
        foreach ($datas as $key => $data) {
            // 取得圖片
            $image = $this->ci->db->get_where('image', array(
                'source_id' => $data['id'], 
                'panel' => $data['panel'], 
                'file_number' => $file_number, 
                'recover' => 0
            ))->row_array();

            if($file_number != 0) {
                // 設定圖片路徑
                if(!empty($image['file_name'])) {
                    $datas[$key]['pic'.$file_number] = base_url($path . $image['file_name']);
                } else {
                    $datas[$key]['pic'.$file_number] = '';
                }
            } else {
                // 設定圖片路徑
                if(!empty($image['file_name'])) {
                    $datas[$key]['pic'] = base_url($path . $image['file_name']);
                } else {
                    $datas[$key]['pic'] = '';
                }
            }
        }
        // p($datas);

        return $datas;
    }
    // 抓取圖片相對路徑-多圖
    public function getImageArray(){
    }
    // 抓取圖片絕對路徑-單圖
    public function getImageURL(){}
    // 抓取圖片絕對路徑-多圖
    public function getImageURLArray(){}
}