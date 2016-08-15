<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function sort()
	{
		// 抓出需要被排序的資料
		$article = $this->db->get_where('article', 
			array('id' => $this->input->get("id"),)
		)->row_array();
		// p($article);
		// 抓出一起排序的資料
		$articles = $this->db->get_where('article', 
			array(
				'panel' => $article['panel'],
				'type' => $article['type'],
				'lang' => $article['lang'],
				'recover' => $article['recover']
			)
		)->result_array();

		// 處理排序的資料
		$articles = arraySort($articles, $article, $this->input->get("sort"));

		foreach ($articles as $key => $article) {
			$this->db->where('id', $article["id"]);
			$input = array(
					'sort' => $article["sort"],
					'updated_at' => date('Y-m-d H:i:s'),
			);
			$this->db->update('article', $input); 
		}

	}

	public function delete()
	{
		// 寫入資料庫
		$this->db->where('id', $this->input->get("id"));
		$input = array(
				'recover' => 1,
				'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->update('article', $input); 
		flashSuccess('刪除資料成功。');

		// 導回原本的頁面
		$panel=$this->input->get("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function insert()
	{
		// 寫入資料庫
		$input = array(
			'panel' => $this->input->post('panel'), 
			'type' => $this->input->post('type'), 
			'name' => $this->input->post('name'), 
			'start_at' => $this->input->post('start_at'), 
			'description' => $this->input->post('description'), 
			'content' => $this->input->post('content'), 
			'field1' => $this->input->post('field1'),
			'field2' => $this->input->post('field2'),
			'show' => $this->input->post('show'),
			'created_at' => date('Y-m-d H:i:s'), 
		);
		$this->db->insert('article', $input); 
		$insert_last_id = $this->db->insert_id();

		// 更新 SORT
		$articles_count =$this->db->get_where('article', array(
			'panel' => $this->input->post('panel'),
			'type' => $this->input->post('type'),
			'lang' => 1, //中文
			'recover' => 0
			// 'type' => $this->input->post('type'), 
		))->num_rows();
		$this->db->where('id', $insert_last_id);
		$this->db->update('article', array('sort' => $articles_count, )); 

		// 查詢對應的 IMAGE 資料，更新 IMAGE
		$images = $this->db->get_where('image', array(
			'file_timestamp' => $this->input->post('file_timestamp'),
		))->result_array();
		foreach ($images as $key => $image) {
			$this->db->where('id', $image['id']);
			$this->db->update('image', array('source_id' => $insert_last_id, )); 
		}

		flashSuccess('新增資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function modify()
	{
		// 寫入資料庫
		$input = array(
			'type' => $this->input->post('type'), 
			'name' => $this->input->post('name'), 
			'start_at' => $this->input->post('start_at'), 
			'description' => $this->input->post('description'), 
			'content' => $this->input->post('content'), 
			'field1' => $this->input->post('field1'),
			'field2' => $this->input->post('field2'),
			'show' => $this->input->post('show'),
			'updated_at' => date('Y-m-d H:i:s'), 
		);
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('article', $input); 

		// 查詢對應的 IMAGE 資料，更新 IMAGE
		$images = $this->db->get_where('image', array(
			'file_timestamp' => $this->input->post('file_timestamp'),
		))->result_array();
		foreach ($images as $key => $image) {
			$this->db->where('id', $image['id']);
			$this->db->update('image', array('source_id' => $this->input->post("id"), )); 
		}
		
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function show()
	{
		$id = $this->input->get("id");
		$show_static = $this->input->get("show_static");
		if($show_static=='open'){
			$show=2;
		}else{
			$show=1;
		}
		$input=array(
			'show' => $show,
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->where('id', $id);
		$this->db->update('article', $input); 
	}
}


