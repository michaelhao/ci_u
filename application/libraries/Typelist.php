<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Typelist
{
    public $typearray = array();
    public $panel = 3;
    public $ci;
    public $type_id = array();

    public function __construct()
    {
        $this->ci = &get_instance();
    }
    
    public function type_list($parent_id, $layer = '')
    {
        $types = $this->ci->db->get_where('type', array(
            'panel' => $this->panel,
            'parent_id' => $parent_id,
            'recover' => 0
        ))->result_array();
        if ($types != null) {
            foreach ($types as $key => $type) {
                $a = $layer;
                if ($parent_id == 0) {
                    $a = '';
                } else {
                    $a .= $parent_id . '#';
                }
                $this->print_type($type['id'], $parent_id, $a);
                $this->type_list($type['id'], $a);
            }
        }
        if ($parent_id == 0) {//搜尋所有類別
            $number = $this->ci->db->get_where('type', array(
                'panel' => $this->panel,
                'recover' => 0
            ))->result_array();
        }else{//只看該父類別下的類別
            $number = $this->ci->db->get_where('type', array(
                'panel' => $this->panel,
                'parent_id' =>$parent_id,
                'recover' => 0
            ))->result_array();
        }
        
        if (count($this->typearray) == count($number)) {
            // p(formOptionArray($this->typearray));
            return $this->typearray;
        }
    }
    
    public function print_type($id, $parent_id, $layer)
    {
        $layer  = $layer . $id; //1#4#5
        $layerL = explode("#", $layer);
        $minus  = '';
        for ($i = 0; $i < count($layerL); $i++) {
            $minus = $minus . '- ';
        }
        $type = $this->ci->db->get_where('type', array(
            'panel' => $this->panel,
            'id' => $id,
            'recover' => 0
        ))->result_array();
        // p($type);
        foreach ($type as $key => $value) {
            $array = array(
                'id' => $id,//本來是用layer
                'name' => $minus . $value['name']
            );
            array_push($this->typearray, $array);
        }
    }


    public function under_type($choose_type){
        if($choose_type==null){
            $this->under_type_search(0);
        }else{
            $this->under_type_search($choose_type);
        }
        return $this->type_id;

    }
    public function under_type_search($choose_type){
        $types = $this->ci->db->get_where('type', array(
            'panel' => $this->panel,
            'parent_id' => $choose_type,
            'recover' => 0
        ))->result_array();
        if ($types != null) {
            foreach ($types as $key => $type) {
                $this->under_type_search($type['id']);
            }
        }else{
            array_push($this->type_id, $choose_type);

        }
    }



}
