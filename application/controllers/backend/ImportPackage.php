<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once './vendor/autoload.php';

class ImportPackage extends CI_Controller
{
    public function update_excel()
    {
        $this->load->view('site/update_excel');
    }

    public function upload() //上傳檔案~限csv與zip
    {
        
        $dir_url   = "assert/files/package/"; //設定上傳檔案存放位置
        $timestamp = time(); //timestamp for mkdir
        if ($_FILES["file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"];
        } else {
            $file_name      = $_FILES["file"]["name"];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            mkdir($dir_url . $timestamp, 0777, true); //儲存的路徑
            move_uploaded_file($_FILES["file"]["tmp_name"], $dir_url . $timestamp . "/" . $file_name);
            if ($file_extension == "zip") { //zip檔解壓縮
                $this->file_unzip($dir_url, $timestamp, $file_name);
            } else if ($file_extension == "csv") { //csv檔匯入資料庫
                $this->import_excel($dir_url, $timestamp, $file_name);
            } else {
                // 導回原本的頁面
                flashError('上傳資料失敗，檔案限 ZIP 或 CSV。');
                $panel=$this->input->post("panel");
                $row=select_submenu($panel);
                redirect($row["typelink"], 'refresh');
            }
        }
    }
    
    public function file_unzip($dir_url, $timestamp, $file_name) //目前解壓在壓縮檔存放位置
    {
        $zip = new ZipArchive;
        if ($zip->open($dir_url . $timestamp . "/" . $file_name) === TRUE) {
            $zip->extractTo($dir_url . $timestamp);
            $paths = glob($dir_url . $timestamp . "/*.csv");
            foreach ($paths as $key => $path) {
                // echo $path . "<br/>";
                $file = basename($path);
                // echo $file . "<br/>";
                $this->import_excel($dir_url, $timestamp, $file);
            }
            $images = glob($dir_url . $timestamp . "/images/*.*");//找image底下的所有檔案
            foreach ($images as $key => $image) {
                $image_name=basename($image);//純檔名
                $this->import_images($dir_url, $timestamp, $image_name);
            }
            $zip->close();
        } else {
            // 導回原本的頁面
            flashError('上傳資料失敗，解壓縮失敗。');
            $panel=$this->input->post("panel");
            $row=select_submenu($panel);
            redirect($row["typelink"], 'refresh');
        }
    }
    public function import_images($dir_url, $timestamp, $file_name){
        $file_type=filetype($dir_url.$timestamp."/images/".$file_name);
        $file_size=filesize($dir_url.$timestamp."/images/".$file_name);
        $url=$dir_url.$timestamp."/images/".$file_name;
        $file_number=$this->split_img($file_name);
        $id=$this->db->select('id, name')->get_where('product', array(
            'number' => $file_name,
            'recover' => 0,
        ))->result_array();
        foreach ($id as $key => $value) {
            $source_id=$value['id'];
        }
        $input = array(
            'panel' => 11,
            'source_id' => $source_id,//用對應的商品id
            'file_timestamp' => $timestamp,
            'url' => base_url($url),
            'file_type' => $file_type,
            'file_name' => $file_name,
            'file_size' => $file_size,
            'file_number' => $file_number,
            'created_at' => date("Y-m-d H:i:s"),
        );
        $this->db->insert('image', $input);
    }
    
    public function import_excel($dir_url, $timestamp, $file_name)
    {
        
        if (!$fp = fopen($dir_url . $timestamp . "/" . $file_name, "r")) { //fopen開啟的是在CI底下的檔案
            echo "cannot open " . $file_name;
            exit;
        } else {
            $size = filesize($dir_url . $timestamp . "/" . $file_name) + 1;
            $row  = 0;
            while ($temp = fgetcsv($fp, $size, ",")) {
                
                if ($row > 0) {
                    foreach ($temp as $key => $str) {
                        $temp[$key] = mb_convert_encoding($temp[$key], "UTF-8", "BIG-5");
                    }
                    $input = array(
                        'number' => $temp[0],
                        'name' => $temp[1],
                        'content' => $temp[2],
                        'description' => $temp[3],
                        'price' => $temp[4],
                        'special_offer' => $temp[5],
                        'pic' => $temp[6],
                        'qty' => $temp[7],
                        'type_main' => $temp[8],
                        'type_minor' => $temp[9],
                        'type_detail' => $temp[10],
                        'color' => $temp[11],
                        'timestamp' => $timestamp,
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    $this->db->insert('import_excel', $input);
                    
                    //檢查將檔案轉移到product & detail是要用新增還是用更新
                    $this->movedata($temp, $timestamp);
                    
                }
                $row = $row + 1;
            }
            fclose($fp);
            // 導回原本的頁面
            flashSuccess('上傳資料成功。');
            $panel=$this->input->post("panel");
            $row=select_submenu($panel);
            redirect($row["link"], 'refresh');
        }
    }
    
    
    public function movedata($temp, $timestamp)
    {
        //檢查 product裡面有沒有同樣的name
        $product_id = $this->check_PTname('product', $temp[1]);
        if ($product_id != 0) { //product中有該商品名稱
            // echo "product中有同樣名稱的商品~用更新<br/>";
            $this->update_product($product_id, $temp, $timestamp);
        } else { //product中無該商品名稱
            // 無->insert 前先檢查 type裡面有沒有同樣的 type_main/minor/detail
            // echo "product中無同樣名稱的商品~檢查類別後新增";
            $main   = $this->check_PTname('type', $temp[8]); //type_main
            $minor  = $this->check_PTname('type', $temp[9]); //type_minor
            $detail = $this->check_PTname('type', $temp[10]); //type_detail

            if ($main != null) {
                if ($minor != null) {
                    if ($detail != null) {
                        $this->insert_product($detail, $temp, $timestamp);
                    } else { //$detail=null
                        $this->insert_type($minor, $temp[10], $timestamp);
                        $detail = $this->check_PTname('type', $temp[10]);
                        $this->insert_product($detail, $temp, $timestamp);
                    }
                } else { //$minor=null
                    $this->insert_type($main, $temp[9], $timestamp);
                    $minor = $this->check_PTname('type', $temp[9]);
                    if ($detail != null) {
                        $this->insert_product($detail, $temp, $timestamp);
                    } else {
                        $this->insert_type($minor, $temp[10], $timestamp);
                        $detail = $this->check_PTname('type', $temp[10]);
                        $this->insert_product($detail, $temp, $timestamp);
                    }
                }
            } else { //$main=null
                $this->insert_type(0, $temp[8], $timestamp);
                $main = $this->check_PTname('type', $temp[8]);
                if ($minor != null) {
                    if ($detail != null) {
                        $this->insert_product($detail, $temp, $timestamp);
                    } else { //$detail=null
                        $this->insert_type($minor, $temp[10], $timestamp);
                        $detail = $this->check_PTname('type', $temp[10]);
                        $this->insert_product($detail, $temp, $timestamp);
                    }
                } else { //$minor=null
                    $this->insert_type($main, $temp[9], $timestamp);
                    $minor = $this->check_PTname('type', $temp[9]);
                    if ($detail != null) {
                        $this->insert_product($detail, $temp, $timestamp);
                    } else {
                        $this->insert_type($minor, $temp[10], $timestamp);
                        $detail = $this->check_PTname('type', $temp[10]);
                        $this->insert_product($detail, $temp, $timestamp);
                    }
                }
            }
        }
    }

    public function insert_type($parent, $name, $timestamp)
    {
        $input = array(
            'panel' => 3,
            'name' => $name,
            'parent_id' => $parent,
            'created_at' => date('Y-m-d H:i:s', $timestamp)
        );
        $this->db->insert('type', $input);
    }

    public function insert_product($type, $temp, $timestamp)
    {
        $product = array(
            'panel' => 11, //11:商品管理
            'number' => $temp[0],
            'name' => $temp[1],
            'content' => $temp[2],
            'description' => $temp[3],
            'price' => $temp[4],
            'special_offer' => $temp[5],
            'pic' => $temp[6], //沒處理,可能會有兩張以上的圖片
            'qty' => $temp[7],
            'type' => $type, //這個type應該是type_detail的id
            'created_at' => date('Y-m-d H:i:s', $timestamp)
        );
        $this->db->insert('product', $product);
        $product_id = $this->check_PTname('product', $temp[1]);
        if ($temp[11] != null) {
            $colors = $this->split_color($temp[11]);
            foreach ($colors as $key => $color) {
                $product_detail = array(
                    'product_id' => $product_id,
                    'qty' => $temp[7],
                    'color' => $color,
                    'created_at' => date('Y-m-d H:i:s', $timestamp)
                );
                $this->db->insert('product_detail', $product_detail);
            }
        }
    }

    public function update_product($product_id, $temp, $timestamp)
    {
        $product = array(
            'content' => $temp[2],
            'description' => $temp[3],
            'price' => $temp[4],
            'special_offer' => $temp[5],
            'pic' => $temp[6], //沒處理,可能會有兩張以上的圖片
            'qty' => $temp[7],
            // 'type' => $type, //這個type應該是type_detail的id
            'updated_at' => date('Y-m-d H:i:s', $timestamp)
        );
        $this->db->where('id', $product_id)->update('product', $product);
        if ($temp[11] != null) {
            $ori_colors = $this->db->select('color')->get_where('product_detail', array(
                'product_id' => $product_id,
                'recover' => 0
            ))->result_array();
            // p($ori_colors);
            $colors     = $this->split_color($temp[11]);
            
            foreach ($ori_colors as $key => $ori_color) { //判斷是否有新增加的顏色
                foreach ($colors as $key2 => $color) {
                    if ($ori_color['color'] == $color) {
                        $colors[$key2] = null;
                    }
                }
            }
            foreach ($colors as $key => $new_color) {
                if ($new_color != null) {
                    $product_detail = array(
                        'product_id' => $product_id,
                        'qty' => $temp[7],
                        'color' => $new_color,
                        'created_at' => date('Y-m-d H:i:s', $timestamp)
                    );
                    $this->db->insert('product_detail', $product_detail);
                    echo "產生新顏色規格<br/>";
                }
            }
        }
    }

    //看product/type裡面有沒有同樣的商品/類別
    public function check_PTname($table_name, $PTname)
    {
        $rows = $this->db->select('id, name')->get_where($table_name, array(
            'recover' => 0
        ))->result_array();
        $id   = null;
        foreach ($rows as $key => $row) {
            // p($row['name']);
            if ($PTname == $row['name']) {
                $id = $row['id']; //如果有該項類別/商品就回傳他的id
            }
        }
        return $id;
    }

    public function split_color($color)
    {
        $colors = explode(",", $color);
        return $colors;
    }
    public function split_img($image){
        $image = explode("_", $image);
        return $image[0];
    }
}
