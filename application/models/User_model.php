<?php 
class User_model extends CI_Model {

        /***
        * 計算會員紅利、購物金、審核黃金區
        * @param int $order_id
        */
        public function bonus($order_id)
        {
                $theorder=$this->db->get_where('order', array('id'=>$order_id))->row_array();
                if ($theorder['status'] == 2) {//出貨狀態已出貨->發送紅利&累計購物金
                        //紅利點
                        $bonus=$theorder['order_total']/bonusEnougth();
                        $user=$this->db->get_where('users', array('id'=>$theorder['order_uid']))->row_array();
                        if ($user['member_level']==1) {//黃金會員才集紅利
                                $bonus=$user['bonus']+(int)$bonus;
                                $input['bonus'] = $bonus;
                        }
                        //購物金
                        $orders=$this->db->get_where('order', array('order_uid'=>$theorder['order_uid'], 'status'=>2))->result_array();
                        $totalmoney=$theorder['order_total'];
                        foreach ($orders as $key => $order) {
                                $totalmoney=$totalmoney+$order['order_total'];
                        }
                        $verify_number=$totalmoney/verifyEnougth();//應該進審核幾次
                        if ((int)$verify_number>$user['verify_number']) {//>目前審核過幾次
                                $input['verify'] = 1;
                        }
                }
                // p($input);
                if(!empty($input)) {
                        $this->db->where('id', $theorder['order_uid']);
                        $this->db->update('users', $input); 
                }
        }

}
?>