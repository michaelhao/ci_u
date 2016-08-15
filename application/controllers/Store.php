<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 實體帳號介面
class Store extends CI_Controller
{
    public function index()
    {
        $this->load->view('store/index');
    }

    public function login() {

        // 驗證碼錯誤
        if($_SESSION['code'] != $this->input->post('code')) {
            $this->session->set_flashdata('store', '驗證碼錯誤');
            redirect(site_url('store/index'));
        }
        // 取得帳號資訊
        $store_account = $this->db->get_where('store_account' , array(
                'acc' => $this->input->post('acc'),
                'pwd' => md5($this->input->post('pwd')),
                'right' => 1,
                'Recover' => 0,
        ))->row_array();

        // 當有抓到使用者
        if(!empty($store_account)) {
            // 更新TOKEN
            $time = time();
            $token = md5($time + (int)$store_account['id']);
            $this->db->where('id' , $store_account['id']);
            $this->db->update('store_account', array('token' => $token, 'login_time' => date('Y-m-d H:i:s', $time))); 

            // 顯示下一頁資訊
            redirect(site_url('store/step001')."?token=".$token);
        } else {
            $this->session->set_flashdata('store', '帳號密碼錯誤');
            redirect(site_url('store/index'));
        }
    }

    public function step001()
    {
        $this->load->view('store/step001');
    }

    public function step002()
    {
        $db = $this->db;
        if($this->input->post('phone')) {
            $db = $db->where('phone', $this->input->post('phone'));
        }
        if($this->input->post('account')) {
            $db = $db->where('account', $this->input->post('account'));
        }
        if($this->input->post('name')) {
            $db = $db->where('name', $this->input->post('name'));
        }
        if($this->input->post('identity')) {
            $db = $db->where('identity', $this->input->post('identity'));
        }
        if($this->input->post('birthday')) {
            $db = $db->where('birthday', $this->input->post('birthday'));
        }
        if($this->input->post('address')) {
            $db = $db->where('address', $this->input->post('address'));
        }
    
        $db = $db->where('isactive', 1);
        $users = $db->get('users')->result_array();            
        $this->load->view('store/step002', array('users' => $users));
    }

   public function step003()
    {
        $user = $this->db->get_where('users' , 
            array('id' => $this->input->get('id')
        ))->row_array();
        $this->load->view('store/step003', array('user' => $user));
    }

   public function step004()
    {
        $user = $this->db->get_where('users' , 
            array('id' => $this->input->get('id')
        ))->row_array();

        $order_total = $this->db->select_sum('order_total')->get_where('order' , 
            array(
                'order_uid' => $this->input->get('id'),
                'status' => 2, // 已出貨
        ))->row_array();

        // p($order_total);
        $this->load->view('store/step004', array('user' => $user, 'order_total' => $order_total['order_total']));
    }

    public function step005()
    {
        $input = array('order' => $this->session->userdata('tmp_order'));
        if(empty($input['order']['bir_gift'])) {
            $input['order']['bir_gift'] = 0;
        }
        // p($input);
        $this->load->view('store/step005', $input);
    }

    public function payment() {
        $result = array(
            'error' => false, 
            'message' => '', 
        );
        // 取得使用者資訊
        $user = $this->db->get_where('users' , 
            array('id' => $this->input->post('user_id')
        ))->row_array();

        if(empty($user)) {
            $result['error'] = true;
            $result['message'] = '找不到會員資料。';
            echo json_encode($result);exit;
        }

        // 取得操作帳號資訊
        $store_account = $this->db->get_where('store_account' , 
            array('token' => $this->input->post('token')
        ))->row_array();

        if(empty($store_account)) {
            $result['error'] = true;
            $result['message'] = '管理帳號，已在其他裝置做登入。';
            echo json_encode($result);exit;
        }

        // 暫存資料在 Session
        if($result['error'] == false) {
            $this->session->set_userdata(
                array(
                    'tmp_order' => $this->input->post()
                )
            );
            echo json_encode($result);exit;
        }
    }

    public function payok() {
        $order = $this->session->userdata('tmp_order');

        // 取得操作帳號資訊
        $store_account = $this->db->get_where('store_account' , array(
                'token' => $order['token'],
        ))->row_array();

        if(empty($store_account)) {
            $this->session->set_flashdata('store', '管理帳號已在其他裝置做登入。');
            redirect(site_url('store/index'),'refresh');
        }

        $note = '';
        // 調整使用者生日禮領取的紀錄
        if(!empty($order['bir_gift'])) {
            $note .= '領取生日禮 ';
        }

        // 調整使用者紅利使用的紀錄
        if(!empty($order['use_point'])) {
            $note .= '兌換紅利'.$order['use_point'].'點';
        }

        // 訂單新增
        $order_id = date('ymd').''.substr(time(), -4).''.sprintf("%04d", $order['user_id']);
        $input = array(
            'order_id' => $order_id,  // 訂單編號
            'order_uid' => $order['user_id'], // 付款人
            'order_payclass' => 'Cash', // 支付方式：現金
            'order_status' => 2, // 訂單狀態：已付款
            'status' => 2,  // 收件狀態：已收件
            'order_postname' => '',  // 收件人
            'order_postaddr' => '',  // 收件人地址
            'order_postphone' => '',  // 收件人電話
            'note' => $note,  // 備註
            'order_total' => $order['total'],  // 訂單金額
            'created_at' => date('Y-m-d H:i:s'), 
            'order_paytime' => date('Y-m-d H:i:s'),  // 付款時間
            'order_postdate' => date('Y-m-d H:i:s'),  // 出貨時間
            'store_from' => $store_account['store'], // 下單分店
            'store_clerk' => $store_account['id'], // 下單店員
        );
        $this->db->insert('order', $input); 
        $last_id = $this->db->insert_id();

        // 寫入訂單細項資訊
        foreach ($order['products'] as $key => $product) {
            // 當產品為選取不可呈現
            if($product['selected'] != 0) {
                $inputCart = array(
                    'order_id' => $order_id,  // 訂單編號
                    'order_pid' => $product['id'],  // 產品
                    'order_pcount' => $product['selected'], // 產品數量
                    'order_pname' => $product['name'], // 產品名稱
                    'order_psubtotal' => $product['special_offer']*$product['selected'], //小記
                    'created_at' => date('Y-m-d H:i:s'), //新增時間
                );
                $this->db->insert('order_detail', $inputCart); 
            }
        }

        // 改會員紅利及審核資格
        $this->load->model('user_model');
        $this->user_model->bonus($last_id);

        // 扣除紅利及調整生日禮物狀態
        $user = $this->db->get_where('users' , array(
                'id' => $order['user_id'],
        ))->row_array();
        $this->db->where('id', $order['user_id']);

        // 調整使用者生日禮領取的紀錄
        if(!empty($order['bir_gift'])) {
            $user['bir_gift'] = $order['bir_gift'];
        }

        // 調整使用者紅利使用的紀錄
        if(!empty($order['use_point'])) {
            $user['bonus'] = $user['bonus'] - $order['use_point'];
        }
        $this->db->update('users', $user); 

        // 清除 SESSION
        $this->session->unset_userdata('tmp_order');

        // 導回登入頁
        redirect(site_url('store/step001')."?token=".$order['token'],'refresh');
    }

    public function sales_report(){
        $store_account =$this->db->get_where('store_account', array(
            'token'=>$this->input->get('token')
        ))->row_array();
        if(empty($store_account)) {
            $this->session->set_flashdata('store', '管理帳號已在其他裝置做登入。');
            redirect(site_url('store/index'),'refresh');
        }
        $this->load->view('store/sales_report', array('store_account' => $store_account));
    }
}


