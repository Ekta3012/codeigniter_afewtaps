<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

  private $_staff_member;
  private $_establishment;

  public function __construct() {
    parent::__construct();

    $this->_staff_member = $this->db->dbprefix('staff_member');
    $this->_establishment = $this->db->dbprefix('establishment');
  }

  public function serverCancelledOrderTestLink() {
    $orderid = (int) $this->input->get('orderid');
    $this->db->where(array('order_id' => $orderid, 'status !=' => 4, 'status !=' => 3));
    $query = $this->db->get('ft_order');

    // Check Intimation before cancel //
    $check_intimation = (int) $this->db->get_where('ft_order_notification', array('order_id' => $orderid, 'notify_status' => 6))->num_rows();

    if ($query->num_rows() > 0 && $check_intimation == 0) {
      $this->db->where('order_id', $orderid)->update('ft_order', array('status' => 4, 'cancel_time' => time()));

      /* Order Cancel Summary */

      $flag = (int) 1;
      $reason = '';
      switch ($flag) {
        case 1:
          $reason = "I have left the venue";
          break;
        case 2:
          $reason = "I want to order something else";
          break;
        case 3:
          $reason = $this->input->post('reason');
          break;
      }

      $data['reason'] = $reason;
      $data['order_id'] = $orderid;
      $data['ctime'] = time();
      $data['user_flag'] = 1;

      $this->db->insert('ft_order_cancel_reason', $data);

      /* close */


      /* Send Order Cancel Notification to Server */

      $msg = "Order #$orderid has been cancelled due to following reason(s): $reason&orderid=$orderid";

      $dbmsg = "Order #$orderid has been cancelled due to following reason(s): $reason";

      $this->db->insert('ft_order_notification', array('order_id' => $orderid, 'notification' => $dbmsg, 'ttime' => time(), 'flag' => 0, 'notify_status' => 5));


      $this->db->select("ft_staff_member.device_token");
      $this->db->where("ft_order.order_id", $orderid);
      $this->db->from("ft_staff_member");
      $this->db->join("ft_order", "ft_order.staff_member_id = ft_staff_member.id");
      $qry = $this->db->get();
      if ($qry->num_rows() > 0) {
        $device_token = $qry->row()->device_token;
        if (!empty($device_token)) {
          require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
          $gcm = new Gcm();
          $gcm->sendNotification($device_token, $msg);
        }
      } else {
        $this->db->select("ft_staff_member.device_token");
        $this->db->where("ft_order.order_id", $orderid);
        $this->db->from("ft_staff_member");
        $this->db->join("ft_order", "ft_order.staff_member_id = ft_staff_member.id");
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
          foreach ($qry->result() as $sdata) {
            $device_token = $sdata->device_token;
            if (!empty($device_token)) {
              require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
              $gcm = new Gcm();
              $gcm->sendNotification($device_token, $msg);
            }
          }
        }
      }
      echo "Success";
    }

    /* Close */
  }

  public function takeOrder() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->takeOrderModule();
    echo json_encode(array('result' => $res));
  }

  public function deliveryInfoOrders() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->deliveryInfoOrdersModule();
    echo json_encode(array('result' => $res));
  }

  public function notificationOrders() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->notificationOrdersModule();
    echo json_encode(array('result' => $res));
  }

  public function deliveryInformationHistory() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->deliveryInformationHistoryModule();
    echo json_encode(array('result' => $res));
  }

  public function userProfile() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->userProfileModule();
    echo json_encode(array('result' => $res));
  }

  public function nudgeReply() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->nudgeReplyModule();
    echo json_encode(array('result' => $res));
  }

  public function reminder() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->reminderOrderModule();
    echo json_encode(array('result' => $res));
  }

  public function orders() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->getOrders();
    echo json_encode(array('result' => $res));
  }

  public function getAllOrders() {
    header('Content-Type: application/json');
    $res = $this->servicemodel->getAllOrdersModule();
    //echo $this->db->last_query();
    echo json_encode(array('result' => $res));
  }
  public function orderHistory() {
    header('Content-Type: application/json');

    $postData = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $postData = json_decode(file_get_contents("php://input"));
      $postData = (array) $postData;
    }
	
    $serverId = (int)($postData['serverid']);
    $limit = (int)($postData['limit']);
    $offset = (int)($postData['offset']);
    $offset = ($offset > 0)?$offset:0;
    $limit = ($limit > 10)?$limit:10;
    if(isset($serverId) && ($serverId >= 1 )){
        $res = $this->servicemodel->orderHistoryModule($serverId,$limit,$offset);
        echo json_encode(array('result' => $res));
    }else{
        $data['success']=false;
        $data['error'] = "Server Id Missing";
        echo json_encode($data);
    }
  }

  public function deliverInformation() {
    // header('Content-Type: application/json');
    $res = $this->servicemodel->deliverInformationModule();

    $emailConfig = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'tech1@xlim.org',
        'smtp_pass' => 'Tech1!@#',
        'charset' => 'utf-8',
        'mailtype' => 'html',
        'newline' => '\\r\
',
        'crlf' => '\\r\
'
    );


    $this->load->library('email', $emailConfig);
    $this->email->from('no-reply@xlimtest1.com', 'xlimtest');
    $this->email->to('tech1@xlim.org, appsdev1@xlim.org');
    $this->email->subject('response json');
    $this->email->message(json_encode(array('result' => $res)));
    $this->email->send();

    echo json_encode(array('result' => $res));
  }

  public function orderDelivered() {
    header('Content-Type: application/json');
    $res = (int) $this->servicemodel->getOrderDeliveredModule();
    echo json_encode(array('result' => $res));
  }

  public function serverCancelledOrder() {
    header('Content-Type: application/json');
    $res = (int) $this->servicemodel->serverCancelledOrderModule();
    echo json_encode(array('result' => $res));
  }

  public function serverOrderDeliveryTime() {
    header('Content-Type: application/json');
    $res = (int) $this->servicemodel->serverOrderDeliveryTimeModule();
    echo json_encode(array('result' => $res));
  }

  public function serverTakeOrder() {
    header('Content-Type: application/json');
    $res = (int) $this->servicemodel->serverTakeOrderModule();
    echo json_encode(array('result' => $res));
  }

  public function createAccount() {
    $response = array();
    if (count($this->input->post()) > 0) {
      $establid = $this->input->post('establid');
      $serverid = $this->input->post('serverid');
      $email = $this->input->post('email');
      $contactno = $this->input->post('contactno');

      $serviceid = $this->isAccountExists($establid, $serverid, $email, $contactno);
      switch ($serviceid) {
        case 0:
          $response['error'] = "true";
          $response['message'] = "An error occurred. !";
          break;
        default:
          $response['error'] = "false";
          $response['message'] = "success";
          $response['id'] = $serviceid;
          break;

        /* $returnval  = (int) $this->servicemodel->saveSmsInfo($contactno, $serviceid, $email);
          switch ($returnval)
          {
          case 1:
          $response['error']    =  "false";
          $response['message']  =  "success";
          $response['id']       =  $serviceid;
          break;
          default:
          $response['error']    =  "true";
          $response['message']  =  "An error occurred. !";
          $response['id']       =  "";
          break;
          }
         */
      }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function isAccountExists($establid = '', $serverid = '', $email = '', $contactno = '') {
    /* $this->db->select('id, branch_id');
      $this->db->where(array($this->_staff_member.'.email_id' => $email, $this->_staff_member.'.employee_id' => $serverid, $this->_staff_member.'.status' => 0, $this->_staff_member.'.contact_no' => $contactno));
      $res = $this->db->get($this->_staff_member);
      if ($res->num_rows() > 0)
      {
      $staff_record =  $res->row();
      $serviceid    =  $staff_record->id;
      $estab_query =  $this->db->select('estab_id')->get_where($this->_establishment, array($this->_establishment.'.estab_id' => $establid));
      if ($estab_query->num_rows() > 0)
      {
      $estab_auto_id = $estab_query->row()->id;
      if ($estab_auto_id == $staff_record->branch_id)
      {
      $this->db->where('id', $serviceid)->update($this->_staff_member, array('device_token' => $device_token));
      return $serviceid;
      }
      else
      return 0;
      }
      else
      return 0;
      }
      else
      return 0;
     */

    $this->db->select("$this->_staff_member.id, $this->_staff_member.branch_id");
    $this->db->where(array($this->_staff_member . '.email_id' => $email, $this->_staff_member . '.employee_id' => $serverid, $this->_staff_member . '.status' => 0, $this->_staff_member . '.contact_no' => $contactno));
    $this->db->where(array($this->_establishment . '.estab_id' => $establid));
    $this->db->from($this->_staff_member);
    $this->db->join($this->_establishment, "$this->_establishment.id = $this->_staff_member.branch_id");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $serviceid = $query->row()->id;

      $password = sha1($this->input->post('pwd'));
      $device_token = $this->input->post('device_token');

      $this->db->where('id', $serviceid)->update($this->_staff_member, array('status' => 1, 'onlinestatus' => 1, 'device_token' => $device_token, 'password' => $password));
      return $serviceid;
    } else
      return 0;
  }

  public function resendOtp() {
    header('Content-Type: application/json');
    if (count($this->input->post()) > 0) {
      $contactno = $this->input->post('contactno');
      $id = $this->input->post('serverid');
      $this->servicemodel->resendOtp($contactno, $id);
      echo json_encode(array('success' => "true"));
    } else
      echo json_encode(array('success' => "false"));
  }

  public function verifyOtp() {
    header('Content-Type: application/json');
    $responseid = (int) $this->servicemodel->verifyOtpModule();
    if ($responseid > 0)
      echo json_encode(array('success' => "$responseid"));
    else
      echo json_encode(array('success' => "0"));
  }

  public function signIn() {
    $response = $this->servicemodel->signInModule();
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function cmsContent($pageid = '') {
    header('Content-Type: application/json');
    $content = $this->servicemodel->cmsContent($pageid);
    echo json_encode(array('response' => $content));
  }

  public function showProfile() {
    $response = (array) $this->servicemodel->showProfileModule();
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function changeStatusOnOffLine() {
    $response = (int) $this->servicemodel->changeStatusOnOffLineModule();
    header('Content-Type: application/json');
    echo json_encode(array('status' => $response));
  }

  public function serverLogout() {
    $response = (int) $this->servicemodel->serverLogoutModule();
    header('Content-Type: application/json');
    echo json_encode(array('status' => $response));
  }

  public function forgotPassword() {
    if (count($this->input->post()) > 0) {
      $contactno = $this->input->post('contactno');
      $responseValue = (int) $this->isValidMobileNumber($contactno);
      if ($responseValue > 0) {
        $returnval = $this->servicemodel->forgotPwdModule($contactno);
        if ($returnval != FALSE) {
          $response["error"] = 'false';
          $response["message"] = "SMS request is initiated! You will be receiving it shortly.";
        } else {
          $response["error"] = 'true';
          $response["message"] = "Error. Try Again!";
        }
      } else {
        $response["error"] = 'true';
        $response["message"] = "Mobile Number is not registered. Please signup";
      }
    } else {
      $response["error"] = 'true';
      $response["message"] = "Validation Error. Try Again!";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }

  private function isValidMobileNumber($contactno = '') {
    return (int) $this->db->query("SELECT * FROM `" . $this->_staff_member . "` WHERE `status` = ? AND `contact_no` = ?", array(1, $contactno))->num_rows();
  }

  public function forgotVerifyOtp() {
    header('Content-Type: application/json');

    $responseid = (int) $this->servicemodel->forgotOtpVerifyModule();
    if ($responseid > 0)
      echo json_encode(array('success' => "$responseid"));
    else
      echo json_encode(array('success' => "0"));
  }

  public function updatePasswordHere() {
    $id = (int) $this->servicemodel->updatePasswordModule();
    header('Content-Type: application/json');
    if ($id > 0)
      echo json_encode(array('success' => $id));
    else
      echo json_encode(array('success' => 0));
  }

  public function menuItemComplete() {
    $id = (int) $this->servicemodel->menuItemCompleteModule();
    header('Content-Type: application/json');
    echo json_encode(array('success' => $id));
  }

  public function changeProfilePic() {
    $id = (int) $this->servicemodel->changeProfilePicModule();
    header('Content-Type: application/json');
    echo json_encode(array('success' => $id));
  }

  //Edit By Web Shuttle - 27th Jan 2017 onwards//

  public function getAllMenu() {
    //echo "Test"; die;
    header('Content-Type: application/json');

    $params = json_decode(file_get_contents('php://input'), true);
    $serverid = $params['serverid'];
    $category_id = $params['category_id'];

    $res = $this->servicemodel->getMenuItems($serverid, '');
    //echo $this->db->last_query();
    //exit;
    echo json_encode(array('result' => $res));
  }

  public function getOrderId() {
    //echo "Test"; die;
    header('Content-Type: application/json');
    $res = $this->servicemodel->getOrderId();
    //echo "<pre>";
    //print_r($res); die;
    //echo $this->db->last_query();
    //exit;    
    echo json_encode($res);
  }

  public function serverTakeOrder1() {
    header('Content-Type: application/json');
    $res = (int) $this->servicemodel->serverTakeOrderModule();
    echo json_encode(array('result' => $res));
  }

  public function viewLocation() {
    header('Content-Type: application/json');
    $params = json_decode(file_get_contents('php://input'), true);
    $serverid = $params['serverid'];
    $res = $this->servicemodel->viewLocationModule($serverid);
    echo json_encode(array('result' => $res));
  }

  public function getThresoldLimit() {
    header('Content-Type: application/json');
    $params = json_decode(file_get_contents('php://input'), true);
    $serverid = $params['serverid'];
    $res = $this->servicemodel->ThresoldLimit($serverid);
    echo json_encode($res);
  }
  
  
  public function updateOrderStatus() {
    header('Content-Type: application/json');
    $params = json_decode(file_get_contents('php://input'), true);
    $orderid = $params['orderid'];
    $res = $this->servicemodel->updateOrder($orderid);
    echo json_encode($res);
  }

}
