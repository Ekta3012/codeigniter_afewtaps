<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Analyticmodel extends CI_Model {

    private $_order;
    private $_estab_rating;
    private $_accounts;
    private $_staff_member;

    public function __construct() {
        parent::__construct();

        $this->_order = $this->db->dbprefix('order');
        $this->_estab_rating = $this->db->dbprefix('estab_rating');
        $this->_accounts = $this->db->dbprefix('accounts');
        $this->_staff_member = $this->db->dbprefix('staff_member');
    }

    public function viewRatingsModule($userid = '') {
        $estabid = getEstablishmentIdByUserId($userid);
        $this->db->select($this->_accounts . '.name, ' . $this->_accounts . '.email, ' . $this->_estab_rating . '.review, ' . $this->_estab_rating . '.reply, ' . $this->_estab_rating . '.ttime, ' . $this->_estab_rating . '.id as rid, ' . $this->_estab_rating . '.rating');
        $this->db->where($this->_estab_rating . '.estabid', $estabid);
        $this->db->order_by($this->_estab_rating . '.ttime', 'desc');
        $this->db->from($this->_estab_rating);
        $this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
        return $this->db->get()->result();
    }

    public function getReply($id = '') {
        $this->db->select('review, reply');
        return $this->db->get_where($this->_estab_rating, array('id' => $id))->row();
    }

    public function addUpdateReply($id = '') {
        $reply = $this->input->post('reply');

        $data['reply'] = $reply;

        $this->db->where('id', $id)->update($this->_estab_rating, $data);

        $resdata = $this->db->select('userid, estabid')->get_where($this->_estab_rating, array('id' => $id))->row();

        $userid = $resdata->userid;
        $estabid = $resdata->estabid;

        $device_token = $this->db->select('device_token')->get_where($this->_accounts, array('id' => $userid))->row()->device_token;

        if (!empty($device_token)) {
            $this->send_notification_ios(array($device_token), array('message' => $reply, 'title' => $estabid));
        }

        redirect('rating/index');
    }

    public function send_notification_ios($requestIds = array(), $message = array()) {
        $registration_ids = array_values($requestIds);
        // Put y$our private key's passphrase here:
        $passphrase = 'Certificates';
        // Put your alert message here:
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $_SERVER['DOCUMENT_ROOT'] . '/fewtaps/files/notification/ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if ($fp) {
            foreach ($registration_ids as $registration_id) {
                // Create the payload body								

                $mainNoti = array('alert' => $message['message'], 'title' => $message['title'], 'badge' => '', 'type' => 'rating', 'sound' => 'default');

                //$mainNoti  =  array_merge($mainNoti,$message);
                $body['aps'] = $mainNoti;

                // Encode the payload as JSON
                $payload = json_encode($body);
                //echo "<pre>";print_r($payload);
                // Build the binary notification
                $msg = chr(0) . pack('n', 32) . pack('H*', trim($registration_id)) . pack('n', strlen($payload)) . $payload;

                // Send it to the server
                $result = fwrite($fp, $msg, strlen($msg));
            }
            // Close the connection to the server
            fclose($fp);
        }
    }

    public function noOfOrders() {
        $first_day_month = strtotime('first day this month');
        

        $months = array();
        $years = array();

        for ($i = 5; $i >= 0; $i--) { // for ($i = 6; $i >= 1; $i--)

            $month_name = date('M', strtotime("-$i month", $first_day_month));
            $full_month_name = date('F', strtotime("-$i month", $first_day_month));
            
            $month_numeric = date('m', strtotime("-$i month", $first_day_month));
            $year = date('Y', strtotime("-$i month", $first_day_month));
            
            $yr = date('y', strtotime("-$i month", $first_day_month));

            $total_days = cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);

            $start_time = mktime(0, 0, 0, $month_numeric, 1, $year);
            
            $start_time."--".date('d-M-Y',$start_time);
            
            $end_time = mktime(23, 59, 59, $month_numeric, $total_days, $year);
            $end_time."--".date('d-M-Y',$end_time);
//            echo "start time = ".$start_time;
//            echo "<br>";
//            echo "end time = ".$end_time;die();

            $mname = $month_name . " '" . $yr;
            $full_month_year = $full_month_name . "-" . $year;
            $this->db->select('COUNT(*) as total');
            $total_orders_qry = $this->db->get_where($this->_order, array('order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
//            echo $this->db->last_query();die();
            $total_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $total_orders_qry->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            $staff_total_orders_qry = $this->db->get_where($this->_order, array('added_by'=>'2','order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $staff_total_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_total_orders_qry->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            $customer_total_orders_qry = $this->db->get_where($this->_order, array('added_by'=>'1','order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $customer_total_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_total_orders_qry->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            
            $completed = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $total_completed_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $completed->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            $staff_completed = $this->db->get_where($this->_order, array('added_by'=>'2','status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $staff_completed_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_completed->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            $customer_completed = $this->db->get_where($this->_order, array('added_by'=>'1','status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $customer_completed_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_completed->total, 
                        'drilldown' => $mname
                    );


            $this->db->select('COUNT(*) as total');
            $cancelled = $this->db->get_where($this->_order, array('status' => 4, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $total_cancelled_order[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $cancelled->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            $staff_cancelled = $this->db->get_where($this->_order, array('added_by'=>'2','status' => 4, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $staff_cancelled_order[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_cancelled->total, 
                        'drilldown' => $mname
                    );
            
            $this->db->select('COUNT(*) as total');
            $customer_cancelled = $this->db->get_where($this->_order, array('added_by'=>'1','status' => 4, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
            $customer_cancelled_order[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_cancelled->total, 
                        'drilldown' => $mname
                    );


            $nudged_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = 2");
            $nudged_orders_count = $nudged_query->row()->total;
            $nudged_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $nudged_orders_count->total, 
                        'drilldown' => $mname
                    );
            
            $threshold_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = 5")->row();
            $total_threshold_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $threshold_query->total, 
                        'drilldown' => $mname
                    );
            
            $staff_threshold_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = '5' and added_by='2'")->row();
            $staff_threshold_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_threshold_query->total, 
                        'drilldown' => $mname
                    );
            
            $customer_threshold_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = '5' and added_by='1'")->row();
            $customer_threshold_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_threshold_query->total, 
                        'drilldown' => $mname
                    );
        }

//        $arr['total_orders'] = json_encode($total_orders);
//        $arr['staff_total_orders'] = json_encode($staff_total_orders);
//        $arr['customer_total_orders'] = json_encode($customer_total_orders);
//        
//        $arr['total_completed_orders'] = json_encode($total_completed_orders);
//        $arr['staff_completed_orders'] = json_encode($staff_completed_orders);
//        $arr['customer_completed_orders'] = json_encode($customer_completed_orders);
//        
//        $arr['total_cancelled_orders'] = json_encode($total_cancelled_order);
//        $arr['staff_cancelled_orders'] = json_encode($staff_cancelled_order);
//        $arr['customer_cancelled_orders'] = json_encode($customer_cancelled_order);
//        
//        $arr['nudged_orders'] = json_encode($nudged_orders);
//        
//        $arr['total_threshold_orders'] = json_encode($total_threshold_orders);
//        $arr['staff_threshold_orders'] = json_encode($staff_threshold_orders);
//        $arr['customer_threshold_orders'] = json_encode($customer_threshold_orders);
//        
        $arr['total_orders'] = ($total_orders);
        $arr['staff_total_orders'] = ($staff_total_orders);
        $arr['customer_total_orders'] = ($customer_total_orders);
        
        $arr['total_completed_orders'] = ($total_completed_orders);
        $arr['staff_completed_orders'] = ($staff_completed_orders);
        $arr['customer_completed_orders'] = ($customer_completed_orders);
        
        $arr['total_cancelled_orders'] = ($total_cancelled_order);
        $arr['staff_cancelled_orders'] = ($staff_cancelled_order);
        $arr['customer_cancelled_orders'] = ($customer_cancelled_order);
        
        $arr['nudged_orders'] = ($nudged_orders);
        
        $arr['total_threshold_orders'] = ($total_threshold_orders);
        $arr['staff_threshold_orders'] = ($staff_threshold_orders);
        $arr['customer_threshold_orders'] = ($customer_threshold_orders);
//        echo '<pre>';
//        print_r($arr);
//        die();
        return $arr;
    }

    public function noOfOrders_new() {

        $staff_total_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where added_by='2'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $total_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $staff_total_orders_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where added_by='2'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2 ")->result_array();
        
        $customer_total_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where added_by='1'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time))")->result_array();
        
        $customer_total_orders_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where added_by='1'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $staff_completed_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='3' and added_by='2' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $total_completed_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='3' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $staff_completed_orders_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='3' and added_by='2' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $customer_completed_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='3' and added_by='1' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $customer_completed_orders_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='3' and added_by='1' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $total_cancelled_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='4'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2 ")->result_array();
        
        $staff_cancelled_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='4' and added_by='2'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time))")->result_array();
        
        $staff_cancelled_orders_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='4' and added_by='2'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        
        $customer_cancelled_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='4' and added_by='1' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $customer_cancelled_orders_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='4' and added_by='1' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $nudged_orders = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='4' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $total_threshold = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='5' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $staff_threshold = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='5' and added_by='2' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $staff_threshold_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='5' and added_by='2' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
        
        $customer_threshold = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,count(order_id) as total_order From ft_order Where status='5' and added_by='1' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
        
        $customer_threshold_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,count(order_id) as total_order From ft_order Where status='5' and added_by='1' GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
                
        

//        $arr['staff_completed_orders'] = json_encode($staff_completed_orders);
//        $arr['customer_completed_orders'] = json_encode($customer_completed_orders);
//        $arr['staff_cancelled_orders'] = json_encode($staff_cancelled_orders);
//        $arr['customer_cancelled_orders'] = json_encode($customer_cancelled_orders);
//        $arr['nudged_orders'] = json_encode($nudged_orders);
//        $arr['staff_threshold'] = json_encode($staff_threshold);
//        $arr['customer_threshold'] = json_encode($customer_threshold);
        $arr['total_orders'] = ($total_orders);
        $arr['staff_total_orders'] = ($staff_total_orders);
        $arr['staff_total_orders_2'] = ($staff_total_orders_2);
        $arr['customer_total_orders'] = ($customer_total_orders);
        $arr['customer_total_orders_2'] = ($customer_total_orders_2);
        
        
        $arr['total_completed_orders'] = ($total_completed_orders);
        $arr['staff_completed_orders'] = ($staff_completed_orders);
        $arr['staff_completed_orders_2'] = ($staff_completed_orders_2);
        $arr['customer_completed_orders'] = ($customer_completed_orders);
        $arr['customer_completed_orders_2'] = ($customer_completed_orders_2);
        
        
        $arr['total_cancelled_orders'] = ($total_cancelled_orders);
        $arr['staff_cancelled_orders'] = ($staff_cancelled_orders);
        $arr['staff_cancelled_orders_2'] = ($staff_cancelled_orders_2);
        $arr['customer_cancelled_orders'] = ($customer_cancelled_orders);
        $arr['customer_cancelled_orders_2'] = ($customer_cancelled_orders_2);
        
        
        $arr['nudged_orders'] = ($nudged_orders);
        
        
        $arr['total_threshold'] = ($total_threshold);
        $arr['staff_threshold'] = ($staff_threshold);
        $arr['staff_threshold_2'] = ($staff_threshold_2);
        $arr['customer_threshold'] = ($customer_threshold);
        $arr['customer_threshold_2'] = ($customer_threshold_2);
        echo '<pre>';
        print_r($arr);
        echo '</pre>';die();
        return $arr;
    }

    public function businessGeneratedModule() {

        $first_day_month = strtotime('first day this month');

        for ($i = 5; $i >= 0; $i--) { // for ($i = 6; $i >= 1; $i--)

            $month_name = date('M', strtotime("-$i month", $first_day_month));
            $full_month_name = date('F', strtotime("-$i month", $first_day_month));
            $month_numeric = date('m', strtotime("-$i month", $first_day_month));

            $year = date('Y', strtotime("-$i month", $first_day_month));

            $yr = date('y', strtotime("-$i month", $first_day_month));

            $total_days = cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);

            $start_time = mktime(0, 0, 0, $month_numeric, 1, $year);
            $end_time = mktime(23, 59, 59, $month_numeric, $total_days, $year);


            $mname = $month_name . " '" . $yr;
            $full_month_year = $full_month_name . "-" . $year;
            
            $this->db->select('SUM(total_amount) as amount');
            $total_price = $this->db->get_where($this->_order, array('status' => '3', 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row()->amount;
//            echo "<br>".$this->db->last_query();
            $total_monthly_generated_business[] = array(
                    'year'=>$year,
                    'month_numeric'=>$month_numeric,
                    'month_name'=>$month_name,
                    'month_year'=>$full_month_year,
                    'amount'=>(int)$total_price,
                    'name' => $mname,
                    'y' => (int) $total_price,
                    'drilldown' => $mname
                );
            
            $this->db->select('SUM(total_amount) as amount');
            $staff_total_price = $this->db->get_where($this->_order, array('added_by'=>'2','status' => '3', 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row()->amount;
//            echo "<br>".$this->db->last_query();
            $staff_monthly_generated_business[] = array(
                    'year'=>$year,
                    'month_numeric'=>$month_numeric,
                    'month_name'=>$month_name,
                    'month_year'=>$full_month_year,
                    'amount'=>(int)$staff_total_price,
                    'name' => $mname,
                    'y' => (int) $staff_total_price,
                    'drilldown' => $mname
                );
            
            $this->db->select('SUM(total_amount) as amount');
            $customer_total_price = $this->db->get_where($this->_order, array('added_by'=>'1','status' => '3', 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row()->amount;
//            echo "<br>".$this->db->last_query();
            $customer_monthly_generated_business[] = array(
                    'year'=>$year,
                    'month_numeric'=>$month_numeric,
                    'month_name'=>$month_name,
                    'month_year'=>$full_month_year,
                    'amount'=>(int)$customer_total_price,
                    'name' => $mname,
                    'y' => (int) $customer_total_price,
                    'drilldown' => $mname
                );
        }
            $data['total_monthly_generated_business'] = $total_monthly_generated_business;
            $data['staff_monthly_generated_business'] = $staff_monthly_generated_business;
            $data['customer_monthly_generated_business'] = $customer_monthly_generated_business;
            
//            echo $this->db->last_query();
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';die();
            
        return $data;
    }
    public function businessGeneratedModule_new() {
        
            $total_monthly_generated_business = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time)) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,SUM(total_amount) as amount From ft_order GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) ) ORDER BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
            
            $staff_monthly_generated_business_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,SUM(total_amount) as amount From ft_order WHERE added_by='2' GROUP BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
            
            $customer_monthly_generated_business_2 = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%M') as month_name,SUM(total_amount) as amount From ft_order WHERE added_by='1' GROUP BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(order_time)) ORDER BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(order_time)) DESC LIMIT 2")->result_array();
            
            $staff_monthly_generated_business = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,SUM(total_amount) as amount From ft_order Where added_by='2'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
            
            $customer_monthly_generated_business = $this->db->query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(order_time) ) as year,EXTRACT(MONTH FROM FROM_UNIXTIME(order_time) ) as month_numeric,DATE_FORMAT(FROM_UNIXTIME(order_time),'%b') as month_name,SUM(total_amount) as amount From ft_order Where added_by='1'  GROUP BY EXTRACT( YEAR_MONTH FROM FROM_UNIXTIME(order_time) )")->result_array();
            
            $data['total_monthly_generated_business'] = $total_monthly_generated_business;
            $data['staff_monthly_generated_business_2'] = $staff_monthly_generated_business_2;
            $data['customer_monthly_generated_business_2'] = $customer_monthly_generated_business_2;
            $data['staff_monthly_generated_business'] = $staff_monthly_generated_business;
            $data['customer_monthly_generated_business'] = $customer_monthly_generated_business;
            
//            echo $this->db->last_query();
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';die();
            
        return $data;
    }
    
    public function getStaffAnalyticStaff($staff_member_id = '', $userid = '') {
        $estabid = getEstablishmentIdByUserId($userid);
        $data['staff_members'] = $this->db->get_where($this->_staff_member, array('branch_id' => $estabid))->result();

        if (!empty($staff_member_id)) {
            $data['staff_member_data'] = $this->db->get_where($this->_staff_member, array('id' => $staff_member_id))->row();

            $first_day_month = strtotime('first day this month');

            for ($i = 5; $i >= 0; $i--) { // for ($i = 6; $i >= 1; $i--)

            $month_name = date('M', strtotime("-$i month", $first_day_month));
            $full_month_name = date('F', strtotime("-$i month", $first_day_month));
            
            $month_numeric = date('m', strtotime("-$i month", $first_day_month));
            $year = date('Y', strtotime("-$i month", $first_day_month));
            
            $yr = date('y', strtotime("-$i month", $first_day_month));

            $total_days = cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);

            $start_time = mktime(0, 0, 0, $month_numeric, 1, $year);
            
            $start_time."--".date('d-M-Y',$start_time);
            
            $end_time = mktime(23, 59, 59, $month_numeric, $total_days, $year);
            $end_time."--".date('d-M-Y',$end_time);
            


            $mname = $month_name . " '" . $yr;
            $full_month_year = $full_month_name . "-" . $year;
            
            $this->db->select('completion_time,order_time,staff_member_id');
            $total_orders_avgtime_qry = $this->db->get_where($this->_order, array('status'=>'3','order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->result_array();
            
//            $total_orders = count($total_orders_avgtime_qry);
            $time_diff = array();
            $complete_orders_counter = 0;
            foreach ($total_orders_avgtime_qry as $avgt){
                if($avgt['completion_time']>0){
                    ++$complete_orders_counter;
                    $time_diff[] = (($avgt['completion_time']) - ($avgt['order_time']));
                }else{
                    $time_diff[] = 0;
                }
            }
            $avg_time_for_this_month = (((array_sum($time_diff))/$complete_orders_counter)/60);
            $avg_time_for_this_month = number_format($avg_time_for_this_month,2);
            $total_orders_avg_time[] = array(
                        'year'=>$year,        
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year, 
                        'avg_time' => $avg_time_for_this_month
                    );
            
            $this->db->select('completion_time,order_time,staff_member_id');
            $staff_total_orders_avgtime_qry = $this->db->get_where($this->_order, array('status'=>'3','order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id,'added_by'=>'2'))->result_array();
            
//            $staff_total_orders = count($staff_total_orders_avgtime_qry);
            $staff_time_diff = array();
            $staff_complete_orders_counter = 0;
            foreach ($staff_total_orders_avgtime_qry as $avgt){
                if($avgt['completion_time']>0){
                    ++$staff_complete_orders_counter;
                    $staff_time_diff[] = (($avgt['completion_time']) - ($avgt['order_time']));
                }else{
                    $staff_time_diff[]=0;
                }
            }
            $avg_time_for_this_month = (((array_sum($staff_time_diff))/$staff_complete_orders_counter)/60);
            $avg_time_for_this_month = number_format($avg_time_for_this_month,2);
            $staff_total_orders_avg_time[] = array(
                        'year'=>$year,        
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year, 
                        'avg_time' => $avg_time_for_this_month
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('completion_time,order_time,staff_member_id');
            $customer_total_orders_avgtime_qry = $this->db->get_where($this->_order, array('status'=>'3','order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id,'added_by'=>'1'))->result_array();      
//            echo $this->db->last_query();
//            echo '<pre>';
//            print_r($customer_total_orders_avgtime_qry);
//            echo '</pre>';
//            die();
//            $customer_total_orders = count($customer_total_orders_avgtime_qry);
            $customer_time_diff = array();
            $customer_complete_orders_counter = 0;
            foreach ($customer_total_orders_avgtime_qry as $avgt){
                if($avgt['completion_time']>0){
                    ++$customer_complete_orders_counter;
                    $customer_time_diff[] = ($avgt['completion_time']-$avgt['order_time']);
                }else{
                    $customer_time_diff[]=0;
                }
            }
//            echo "customer_complete_orders_counter = ".$customer_complete_orders_counter;
            $avg_time_for_this_month = (((array_sum($customer_time_diff))/$customer_complete_orders_counter)/60);
            $avg_time_for_this_month = number_format($avg_time_for_this_month,2);
            $customer_total_orders_avg_time[] = array(
                        'year'=>$year,        
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year, 
                        'avg_time' => $avg_time_for_this_month
                    );
            
            $this->db->select('COUNT(*) as total');
            $total_orders_qry = $this->db->get_where($this->_order, array('order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $total_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $total_orders_qry->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $staff_total_orders_qry = $this->db->get_where($this->_order, array('order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id,'added_by'=>'2'))->row();
            $staff_total_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_total_orders_qry->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $customer_total_orders_qry = $this->db->get_where($this->_order, array('order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id,'added_by'=>'1'))->row();
            $customer_total_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_total_orders_qry->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $completed = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $total_completed_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $completed->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $staff_completed = $this->db->get_where($this->_order, array('added_by'=>'2','status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $staff_completed_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_completed->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $customer_completed = $this->db->get_where($this->_order, array('added_by'=>'1','status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $customer_completed_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_completed->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $cancelled = $this->db->get_where($this->_order, array('status' => 4, 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $total_cancelled_order[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $cancelled->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $staff_cancelled = $this->db->get_where($this->_order, array('added_by'=>'2','status' => 4, 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $staff_cancelled_order[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_cancelled->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('COUNT(*) as total');
            $customer_cancelled = $this->db->get_where($this->_order, array('added_by'=>'1','status' => 4, 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row();
            $customer_cancelled_order[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_cancelled->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $threshold_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = '5' and staff_member_id = '$staff_member_id' ")->row();
            $total_threshold_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $threshold_query->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $staff_threshold_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = '5' and added_by='2'  and staff_member_id = '$staff_member_id' ")->row();
            $staff_threshold_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $staff_threshold_query->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $customer_threshold_query = $this->db->query("SELECT COUNT(*) as total FROM `$this->_order` WHERE `order_time` >= $start_time AND `order_time` <= $end_time AND `status` = '5' and added_by='1'  and staff_member_id = '$staff_member_id' ")->row();
            $customer_threshold_orders[] = array(
                        'year'=>$year,
                        'month_numeric'=>$month_numeric,
                        'month_name'=>$month_name,
                        'month_year'=>$full_month_year,
                        'name' => $mname, 
                        'total_order' => (int) $customer_threshold_query->total, 
                        'drilldown' => $mname
                    );
//            echo "<br>".$this->db->last_query();
            
            $this->db->select('SUM(total_amount) as amount');
            $total_price = $this->db->get_where($this->_order, array('status' => '3', 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row()->amount;
//            echo "<br>".$this->db->last_query();
            $total_monthly_generated_business[] = array(
                    'year'=>$year,
                    'month_numeric'=>$month_numeric,
                    'month_name'=>$month_name,
                    'month_year'=>$full_month_year,
                    'amount'=>(int)$total_price,
                    'name' => $mname,
                    'y' => (int) $total_price,
                    'drilldown' => $mname
                );
            
            $this->db->select('SUM(total_amount) as amount');
            $staff_total_price = $this->db->get_where($this->_order, array('added_by'=>'2','status' => '3', 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row()->amount;
//            echo "<br>".$this->db->last_query();
            $staff_monthly_generated_business[] = array(
                    'year'=>$year,
                    'month_numeric'=>$month_numeric,
                    'month_name'=>$month_name,
                    'month_year'=>$full_month_year,
                    'amount'=>(int)$staff_total_price,
                    'name' => $mname,
                    'y' => (int) $staff_total_price,
                    'drilldown' => $mname
                );
            
            $this->db->select('SUM(total_amount) as amount');
            $customer_total_price = $this->db->get_where($this->_order, array('added_by'=>'1','status' => '3', 'order_time >=' => $start_time, 'order_time <=' => $end_time,'staff_member_id' => $staff_member_id))->row()->amount;
//            echo "<br>".$this->db->last_query();
            $customer_monthly_generated_business[] = array(
                    'year'=>$year,
                    'month_numeric'=>$month_numeric,
                    'month_name'=>$month_name,
                    'month_year'=>$full_month_year,
                    'amount'=>(int)$customer_total_price,
                    'name' => $mname,
                    'y' => (int) $customer_total_price,
                    'drilldown' => $mname
                );
        }
        
        $data['total_orders_avg_time'] = ($total_orders_avg_time);
        $data['staff_total_orders_avg_time'] = ($staff_total_orders_avg_time);
        $data['customer_total_orders_avg_time'] = ($customer_total_orders_avg_time);

        $data['total_orders'] = ($total_orders);
        $data['staff_total_orders'] = ($staff_total_orders);
        $data['customer_total_orders'] = ($customer_total_orders);
        
        $data['total_completed_orders'] = ($total_completed_orders);
        $data['staff_completed_orders'] = ($staff_completed_orders);
        $data['customer_completed_orders'] = ($customer_completed_orders);
        
        $data['total_cancelled_orders'] = ($total_cancelled_order);
        $data['staff_cancelled_orders'] = ($staff_cancelled_order);
        $data['customer_cancelled_orders'] = ($customer_cancelled_order);
        
        $data['total_threshold_orders'] = ($total_threshold_orders);
        $data['staff_threshold_orders'] = ($staff_threshold_orders);
        $data['customer_threshold_orders'] = ($customer_threshold_orders);
        
        $data['total_monthly_generated_business'] = $total_monthly_generated_business;
        $data['staff_monthly_generated_business'] = $staff_monthly_generated_business;
        $data['customer_monthly_generated_business'] = $customer_monthly_generated_business;
        
        //LIST OF ORDERS START HERE
        $data['orders_list'] = $this->get_orders_of_staff_member($staff_member_id);
        //LIST OF ORDERS END HERE
//                echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die();
        }
        return $data;
    }
    public function get_orders_of_staff_member($staff_member_id){
        $this->db->order_by('order_id','desc');
        $list_of_all_orders_qry = $this->db->get_where('ft_order',array('staff_member_id'=>$staff_member_id))->result_array();
        $i=0;
        foreach ($list_of_all_orders_qry as $liao){
            //TO FIND TABLE LOCATION
            $location = $liao['location'];
            $location = explode(',', $location);
            $floor_id = $location[0];
            $location_id = $location[1];
            
            $floor_name = $this->db->get_where('ft_restaurants_floor',array('id'=>$floor_id))->row_array();
            $floor_name = $floor_name['floor_id'];
            $location_name = $this->db->get_where('ft_restaurants_location',array('id'=>$location_id))->row_array();
            $location_name = $location_name['location_name'];
            $list_of_all_orders_qry[$i]=$liao;
            $list_of_all_orders_qry[$i]['floor_name']=$floor_name;
            $list_of_all_orders_qry[$i]['location_name']=$location_name;
            
            //TO FIND STAFF MEMBER NAME
            $staff_member_name = $this->db->get_where('ft_staff_member',array('id'=>$staff_member_id))->row_array();
            $list_of_all_orders_qry[$i]['staff_member_name'] = $staff_member_name['name'];
            
            //TO FIND ORDER ITEMS
            $order_id = $liao['order_id'];
            $ord_detail_qry = $this->db->query("Select * from ft_order_menu_id as fomi "
                    . "LEFT JOIN ft_menu_items as fmi on fmi.id=fomi.menu_id "
                    . "WHERE fomi.order_id='$order_id'")->result_array();
            $ii=0;
//            echo "ord_detail_qry = ".count($ord_detail_qry);
            $item = array();
            foreach ($ord_detail_qry as $odq){
                $item[$ii]['qty']=$odq['qty'];
                $item[$ii]['name']=$odq['item_name'];
                $item[$ii]['price']=$odq['price'];
                $menu_id = $odq['menu_id'];
                
                $find_order_customzation = $this->db->query("Select * from ft_order_menu_customization_type as "
                        . "fomct LEFT JOIN ft_menu_customization_type as fmct on "
                        . "fmct.id=fomct.customization_type_id WHERE fomct.order_id='$order_id' and "
                        . "fomct.order_menu_id='$menu_id' ")->result_array();
                $iii=0;
                $optionsss = array();
                $options = array();
                foreach ($find_order_customzation as $foc){
                    $optionsss['name']=$foc['customization_name'];
                    $customization_type_id=$foc['customization_type_id'];
                    $menu_id=$foc['order_menu_id'];
                    
                    $find_order_customzation_opt = $this->db->query("Select * from ft_order_menu_customization_options as fomco LEFT JOIN ft_menu_customization_options as fmco on fmco.id=fomco.customization_options WHERE fomco.order_id='$order_id' and fomco.order_menu_id='$menu_id' and fmco.customization_type_id='$customization_type_id' ")->result_array();
                    
                    $iiii=0;
                    $optionsss['options'] = array();
                    foreach ($find_order_customzation_opt as $foco){
                        $optionsss['options'][] = array('option_name'=>$foco['option_name'],'price'=>$foco['price']);
                                ++$iiii;
                    }
                    ++$iii;
                $options[] = $optionsss;
                }

                $item[$ii]['customization']=$options;
                ++$ii;
            }
            $list_of_all_orders_qry[$i]['item_detail'] = $item;
            
            ++$i;
        }
        $this->db->order_by('order_id','desc');
        $list_of_staff_orders_qry = $this->db->get_where('ft_order',array('staff_member_id'=>$staff_member_id,'added_by'=>'2'))->result_array();
        
        $i=0;
        foreach ($list_of_staff_orders_qry as $losoq){
            //TO FIND TABLE LOCATION
            $location = $losoq['location'];
            $location = explode(',', $location);
            $floor_id = $location[0];
            $location_id = $location[1];
            
            $floor_name = $this->db->get_where('ft_restaurants_floor',array('id'=>$floor_id))->row_array();
            $floor_name = $floor_name['floor_id'];
            $location_name = $this->db->get_where('ft_restaurants_location',array('id'=>$location_id))->row_array();
            $location_name = $location_name['location_name'];
            $list_of_staff_orders_qry[$i]=$losoq;
            $list_of_staff_orders_qry[$i]['floor_name']=$floor_name;
            $list_of_staff_orders_qry[$i]['location_name']=$location_name;
            
            //TO FIND STAFF MEMBER NAME
            $staff_member_name = $this->db->get_where('ft_staff_member',array('id'=>$staff_member_id))->row_array();
            $list_of_staff_orders_qry[$i]['staff_member_name'] = $staff_member_name['name'];
            
            //TO FIND ORDER ITEMS
            $order_id = $losoq['order_id'];
            $ord_detail_qry = $this->db->query("Select * from ft_order_menu_id as fomi "
                    . "LEFT JOIN ft_menu_items as fmi on fmi.id=fomi.menu_id "
                    . "WHERE fomi.order_id='$order_id'")->result_array();
            $ii=0;
//            echo "ord_detail_qry = ".count($ord_detail_qry);
            $item = array();
            foreach ($ord_detail_qry as $odq){
                $item[$ii]['qty']=$odq['qty'];
                $item[$ii]['name']=$odq['item_name'];
                $item[$ii]['price']=$odq['price'];
                $menu_id = $odq['menu_id'];
                
                $find_order_customzation = $this->db->query("Select * from ft_order_menu_customization_type as "
                        . "fomct LEFT JOIN ft_menu_customization_type as fmct on "
                        . "fmct.id=fomct.customization_type_id WHERE fomct.order_id='$order_id' and "
                        . "fomct.order_menu_id='$menu_id' ")->result_array();
                $iii=0;
                $optionsss = array();
                $options = array();
                foreach ($find_order_customzation as $foc){
                    $optionsss['name']=$foc['customization_name'];
                    $customization_type_id=$foc['customization_type_id'];
                    $menu_id=$foc['order_menu_id'];
                    
                    $find_order_customzation_opt = $this->db->query("Select * from ft_order_menu_customization_options as fomco LEFT JOIN ft_menu_customization_options as fmco on fmco.id=fomco.customization_options WHERE fomco.order_id='$order_id' and fomco.order_menu_id='$menu_id' and fmco.customization_type_id='$customization_type_id' ")->result_array();
                    
                    $iiii=0;
                    $optionsss['options'] = array();
                    foreach ($find_order_customzation_opt as $foco){
                        $optionsss['options'][] = array('option_name'=>$foco['option_name'],'price'=>$foco['price']);
                                ++$iiii;
                    }
                    ++$iii;
                $options[] = $optionsss;
                }

                $item[$ii]['customization']=$options;
                ++$ii;
            }
            $list_of_staff_orders_qry[$i]['item_detail'] = $item;
            
            ++$i;
        }
        
        $this->db->order_by('order_id','desc');
        $list_of_customer_orders_qry = $this->db->get_where('ft_order',array('staff_member_id'=>$staff_member_id,'added_by'=>'1'))->result_array();
        
        $i=0;
        foreach ($list_of_customer_orders_qry as $locoq){
            //TO FIND TABLE LOCATION
            $location = $locoq['location'];
            $location = explode(',', $location);
            $floor_id = $location[0];
            $location_id = $location[1];
            
            $floor_name = $this->db->get_where('ft_restaurants_floor',array('id'=>$floor_id))->row_array();
            $floor_name = $floor_name['floor_id'];
            $location_name = $this->db->get_where('ft_restaurants_location',array('id'=>$location_id))->row_array();
            $location_name = $location_name['location_name'];
            $list_of_customer_orders_qry[$i]=$locoq;
            $list_of_customer_orders_qry[$i]['floor_name']=$floor_name;
            $list_of_customer_orders_qry[$i]['location_name']=$location_name;
            
            //TO FIND STAFF MEMBER NAME
            $staff_member_name = $this->db->get_where('ft_staff_member',array('id'=>$staff_member_id))->row_array();
            $list_of_customer_orders_qry[$i]['staff_member_name'] = $staff_member_name['name'];
            
            //TO FIND ORDER ITEMS
            $order_id = $locoq['order_id'];
            $ord_detail_qry = $this->db->query("Select * from ft_order_menu_id as fomi "
                    . "LEFT JOIN ft_menu_items as fmi on fmi.id=fomi.menu_id "
                    . "WHERE fomi.order_id='$order_id'")->result_array();
            $ii=0;
//            echo "ord_detail_qry = ".count($ord_detail_qry);
            $item = array();
            foreach ($ord_detail_qry as $odq){
                $item[$ii]['qty']=$odq['qty'];
                $item[$ii]['name']=$odq['item_name'];
                $item[$ii]['price']=$odq['price'];
                $menu_id = $odq['menu_id'];
                
                $find_order_customzation = $this->db->query("Select * from ft_order_menu_customization_type as "
                        . "fomct LEFT JOIN ft_menu_customization_type as fmct on "
                        . "fmct.id=fomct.customization_type_id WHERE fomct.order_id='$order_id' and "
                        . "fomct.order_menu_id='$menu_id' ")->result_array();
                $iii=0;
                $optionsss = array();
                $options = array();
                foreach ($find_order_customzation as $foc){
                    $optionsss['name']=$foc['customization_name'];
                    $customization_type_id=$foc['customization_type_id'];
                    $menu_id=$foc['order_menu_id'];
                    
                    $find_order_customzation_opt = $this->db->query("Select * from ft_order_menu_customization_options as fomco LEFT JOIN ft_menu_customization_options as fmco on fmco.id=fomco.customization_options WHERE fomco.order_id='$order_id' and fomco.order_menu_id='$menu_id' and fmco.customization_type_id='$customization_type_id' ")->result_array();
                    
                    $iiii=0;
                    $optionsss['options'] = array();
                    foreach ($find_order_customzation_opt as $foco){
                        $optionsss['options'][] = array('option_name'=>$foco['option_name'],'price'=>$foco['price']);
                                ++$iiii;
                    }
                    ++$iii;
                $options[] = $optionsss;
                }

                $item[$ii]['customization']=$options;
                ++$ii;
            }
            $list_of_customer_orders_qry[$i]['item_detail'] = $item;
            
            ++$i;
        }
        
        //LIST OF ORDERS END HERE
        $data['list_of_all_orders'] = $list_of_all_orders_qry;
        $data['list_of_staff_orders'] = $list_of_staff_orders_qry;
        $data['list_of_customer_orders'] = $list_of_customer_orders_qry;
//        echo '<pre>';
//        print_r($data['list_of_all_orders']);
//        echo '</pre>';
//        die();
        return $data;
    }

    public function getStaffAnalyticStaff_old($staff_member_id = '', $userid = '') {
        $estabid = getEstablishmentIdByUserId($userid);
        $data['staff_members'] = $this->db->get_where($this->_staff_member, array('branch_id' => $estabid))->result();

        if (!empty($staff_member_id)) {
            $data['staff_member_data'] = $this->db->get_where($this->_staff_member, array('id' => $staff_member_id))->row();

            $first_day_month = strtotime('first day this month');

            for ($i = 5; $i >= 0; $i--) {

                $month_name = date('M', strtotime("-$i month", $first_day_month));

                $month_numeric = date('m', strtotime("-$i month", $first_day_month));

                $year = date('Y', strtotime("-$i month", $first_day_month));

                $yr = date('y', strtotime("-$i month", $first_day_month));

                $total_days = cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);

                $start_time = mktime(0, 0, 0, $month_numeric, 1, $year);
                $end_time = mktime(23, 59, 59, $month_numeric, $total_days, $year);

                $mname = $month_name . " '" . $yr;

                $this->db->select('SUM(total_amount) as amount');
                $total_price = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'staff_member_id' => $staff_member_id))->row()->amount;

                $success_order = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'staff_member_id' => $staff_member_id))->num_rows();


                $this->db->select('SUM(completion_time - order_time) as total_time');
                $month_total_time = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'staff_member_id' => $staff_member_id))->row()->total_time;

                $cmminutes = $month_total_time / 60;

                $business[] = array('name' => $mname, 'y' => (int) $total_price, 'drilldown' => $mname);
                $order[] = array('name' => $mname, 'y' => (int) $success_order, 'drilldown' => $mname);
                $avg_time[] = array('name' => $mname, 'y' => $cmminutes, 'drilldown' => $mname);


                /* if ($i <= 1)
                  {
                  $key 								=  ($i == 0) ? "current" : "prev";
                  $data['month'][$key]['price']       =  $total_price;
                  $data['month'][$key]['month_name']  =  $month_name. ' '.$year;
                  $data['month'][$key]['success']     =  $success_order;
                  }
                  else
                  $data['prev'][] = array('name' => $mname, 'y' => $total_price, 'drilldown' => $mname, 'success' => $success_order);
                 */
            }

            $data['business'] = json_encode($business);
            $data['order'] = json_encode($order);
            $data['avg_time'] = json_encode($avg_time);

            /* Calculate last month busines */

            $last_moth_str_time = strtotime('first day of last month');

            $data['last_month_name'] = date('F Y', $last_moth_str_time);

            list ($last_month_year, $last_month_no, $last_month_date) = explode('/', date('Y/m/d', $last_moth_str_time));


            $total_days_last_month = cal_days_in_month(CAL_GREGORIAN, $last_month_no, $last_month_year); // date('t', $last_moth_str_time);

            $last_month_start_mktime = mktime(0, 0, 0, $last_month_no, $last_month_date, $last_month_year);
            $last_month_end_mktime = mktime(23, 59, 59, $last_month_no, $total_days_last_month, $last_month_year);

            /* Business */

            $this->db->select('SUM(total_amount) as amount');
            $last_month_business = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $last_month_start_mktime, 'order_time <=' => $last_month_end_mktime, 'staff_member_id' => $staff_member_id))->row()->amount;
            $data['last_month_business'] = (int) $last_month_business;

            /* close */

            /* No of  Orders */

            $last_month_total_orders = (int) $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $last_month_start_mktime, 'order_time <=' => $last_month_end_mktime, 'staff_member_id' => $staff_member_id))->num_rows();
            $data['last_month_order'] = (int) $last_month_total_orders;

            /* close */

            /* Calculate average time */

            $this->db->select('SUM(completion_time - order_time) as total_time');
            $last_month_total_time = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $last_month_start_mktime, 'order_time <=' => $last_month_end_mktime, 'staff_member_id' => $staff_member_id))->row()->total_time;

            $minutes = $last_month_total_time / 60;

            $data['last_month_average_time'] = $minutes;

            /* close */



            /* Calculate this month busines so far */

            $this_month_start_mktime = mktime(0, 0, 0, date('m'), 1, date('Y'));
            $this_month_end_mktime = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

            $this->db->select('SUM(total_amount) as amount');
            $this_month_price = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $this_month_start_mktime, 'order_time <=' => $this_month_end_mktime, 'staff_member_id' => $staff_member_id))->row()->amount;
            $data['this_month_price'] = (int) $this_month_price;


            /* No of  Orders */

            $this_month_total_orders = (int) $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $this_month_start_mktime, 'order_time <=' => $this_month_end_mktime, 'staff_member_id' => $staff_member_id))->num_rows();
            $data['this_month_orders'] = $this_month_total_orders;

            /* close */

            /* Calculate average time */

            $this->db->select('SUM(completion_time - order_time) as total_time');
            $this_month_total_time = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $this_month_start_mktime, 'order_time <=' => $this_month_end_mktime, 'staff_member_id' => $staff_member_id))->row()->total_time;

            $tminutes = $this_month_total_time / 60;

            $data['this_month_average_time'] = $tminutes;

            /* close */

            /* Get All Orders */

            $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

            $data['orders'] = $this->db->get_where($this->_order, array('staff_member_id' => $staff_member_id, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->result();
        }
        return $data;
    }

    public function getPotentialBusinessAjax() {
        $start_date = $this->input->get_post('sdate');
        $end_date = $this->input->get_post('edate');

        $staff_member_id = $this->uri->segment(3);

        if (!empty($start_date) && !empty($end_date)) {
            list ($smonth, $sdate, $syear) = explode('/', $start_date);
            list ($emonth, $edate, $eyear) = explode('/', $end_date);

            $date1 = mktime(0, 0, 0, $smonth, $sdate, $syear);
            $date2 = mktime(0, 0, 0, $emonth, $edate, $eyear);

            $output = [];

            $time = $date1;

            $last = date('m', $date2);

            do {
                $month = date('m', $time);
                $year = date('Y', $time);

                $mname = date('M', $time) . " '" . date('y', $time);

                $stime = mktime(0, 0, 0, $month, 1, $year);
                $etime = mktime(23, 59, 59, $month, date('t', $time), $year);

                $this->db->select('COUNT(*) as total');
                $completed = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $stime, 'order_time <=' => $etime, 'staff_member_id' => $staff_member_id))->row();

                $completed_order[] = array('name' => $mname, 'y' => (int) $completed->total, 'drilldown' => $mname);

                $time = strtotime('+1 month', $time);
            } while ($month != $last);

            return $completed_order;
        }
    }

    public function getTotalOrdersAnalyticsModule() {
        $start_date = $this->input->post('sdate');
        $end_date = $this->input->post('edate');

        $staff_member_id = $this->uri->segment(3);

        if (!empty($start_date) && !empty($end_date)) {
            list ($smonth, $sdate, $syear) = explode('/', $start_date);
            list ($emonth, $edate, $eyear) = explode('/', $end_date);

            $date1 = mktime(0, 0, 0, $smonth, $sdate, $syear);
            $date2 = mktime(0, 0, 0, $emonth, $edate, $eyear);

            $output = [];

            $time = $date1;

            $last = date('m', $date2);

            do {
                $month = date('m', $time);
                $year = date('Y', $time);

                $mname = date('M', $time) . " '" . date('y', $time);

                $stime = mktime(0, 0, 0, $month, 1, $year);
                $etime = mktime(23, 59, 59, $month, date('t', $time), $year);

                $this->db->select('COUNT(*) as total');
                $completed = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $stime, 'order_time <=' => $etime, 'staff_member_id' => $staff_member_id))->row();

                $completed_order[] = array('name' => $mname, 'y' => (int) $completed->total, 'drilldown' => $mname);

                $time = strtotime('+1 month', $time);
            } while ($month != $last);

            return $completed_order;
        }
    }

    public function getAvgTimeAnalyticsDataModule() {
        $start_date = $this->input->post('sdate');
        $end_date = $this->input->post('edate');

        $staff_member_id = $this->uri->segment(3);

        if (!empty($start_date) && !empty($end_date)) {
            list ($smonth, $sdate, $syear) = explode('/', $start_date);
            list ($emonth, $edate, $eyear) = explode('/', $end_date);

            $date1 = mktime(0, 0, 0, $smonth, $sdate, $syear);
            $date2 = mktime(0, 0, 0, $emonth, $edate, $eyear);

            $output = [];

            $time = $date1;

            $last = date('m', $date2);

            do {
                $month = date('m', $time);
                $year = date('Y', $time);

                $mname = date('M', $time) . " '" . date('y', $time);

                $stime = mktime(0, 0, 0, $month, 1, $year);
                $etime = mktime(23, 59, 59, $month, date('t', $time), $year);

                $this->db->select('SUM(completion_time - order_time) as total_time');
                $completed = $this->db->get_where($this->_order, array('status' => 3, 'order_time >=' => $stime, 'order_time <=' => $etime, 'staff_member_id' => $staff_member_id))->row();

                $ttime = $completed->total_time / 60;

                $completed_order[] = array('name' => $mname, 'y' => (int) $ttime, 'drilldown' => $mname);

                $time = strtotime('+1 month', $time);
            } while ($month != $last);

            return $completed_order;
        }
    }

    public function getAjaxOrdersModule() {
        $start_date = $this->input->post('sdate');
        $end_date = $this->input->post('edate');

        $staff_member_id = $this->uri->segment(3);

        if (!empty($start_date) && !empty($end_date)) {
            list ($smonth, $sdate, $syear) = explode('/', $start_date);
            list ($emonth, $edate, $eyear) = explode('/', $end_date);

            $stime = mktime(0, 0, 0, $smonth, $sdate, $syear);
            $etime = mktime(23, 59, 59, $emonth, $edate, $eyear);

            $qry = $this->db->get_where($this->_order, array('order_time >=' => $stime, 'order_time <=' => $etime, 'staff_member_id' => $staff_member_id));

            $arr = array();

            if ($qry->num_rows() > 0) {
                foreach ($qry->result() as $odata) {
                    if (!empty($odata->completion_time)) {
                        $diff = ($odata->completion_time - $odata->order_time) / 60;
                    } else
                        $diff = '---';

                    switch ($odata->status) {
                        case 1:
                            $order_status = "Preparation";
                            break;
                        case 2:
                            $order_status = "Priority";
                            break;
                        case 3:
                            $order_status = "Completed";
                            break;
                        case 4:
                            $order_status = "Cancelled";
                            break;
                        case 5:
                            $order_status = "Threshold";
                            break;
                    }

                    $arr[] = array('oid' => $odata->order_id, 'time' => date('H:i M d, Y', $odata->order_time), 'status' => $order_status, 'loc' => 'Audi 1 &raquo; Row 5 &raquo; Seat no. 49', 'ctime' => $diff, 'amt' => $odata->total_amount);
                }
            }
        }
        return $arr;
    }

}
