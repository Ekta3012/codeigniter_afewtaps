<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Servicemodel extends CI_Model {

  private $_accounts;
  private $_staff_member;
  private $_sms_codes;
  private $_service_cms;
  private $_service_gcm;
  private $_order;
  private $_menu_items;
  private $_order_menu_id;
  private $_order_menu_customization_type;
  private $_order_menu_customization_options;
  private $_users;
  private $_menu_customization_type;
  private $_menu_customization_options;
  private $_payment_method;
  private $_order_notification;
  private $_staff_sms_codes;
  private $_order_comment;
  private $_order_cancel_reason;
  private $_delivery_intimation_count;
  private $_dont_ask_nudge;
  private $_folder_root;
  private $_merchant_estab;
  private $_menu_category;
  private $_category;
  private $_order_menu_comment;
  
  
  private $_restaurants_location;
  private $_restaurants_floor;
  private $_cinema_audi;
  
  private $_threshold;

  public function __construct() {
    parent::__construct();

    $this->_accounts = $this->db->dbprefix('accounts');
    $this->_staff_member = $this->db->dbprefix('staff_member');
    $this->_sms_codes = $this->db->dbprefix('sms_codes');
    $this->_service_cms = $this->db->dbprefix('service_cms');
    $this->_service_gcm = $this->db->dbprefix('service_gcm');
    $this->_order = $this->db->dbprefix('order');
    $this->_menu_items = $this->db->dbprefix('menu_items');
    $this->_order_menu_id = $this->db->dbprefix('order_menu_id');
    $this->_order_menu_customization_type = $this->db->dbprefix('order_menu_customization_type');
    $this->_order_menu_customization_options = $this->db->dbprefix('order_menu_customization_options');
    $this->_users = $this->db->dbprefix('accounts');
    $this->_menu_customization_type = $this->db->dbprefix('menu_customization_type');
    $this->_menu_customization_options = $this->db->dbprefix('menu_customization_options');
    $this->_payment_method = $this->db->dbprefix('payment_method');
    $this->_order_notification = $this->db->dbprefix('order_notification');
    $this->_staff_sms_codes = $this->db->dbprefix('staff_sms_codes');
    $this->_order_comment = $this->db->dbprefix('order_comment');
    $this->_order_cancel_reason = $this->db->dbprefix('order_cancel_reason');
    $this->_delivery_intimation_count = $this->db->dbprefix('delivery_intimation_count');
    $this->_dont_ask_nudge = $this->db->dbprefix('dont_ask_nudge');
    $this->_folder_root = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';


    $this->_merchant_estab = $this->db->dbprefix('merchant_estab');
    $this->_menu_category = $this->db->dbprefix('menu_category');
    $this->_category = $this->db->dbprefix('category');
    $this->_order_menu_comment = $this->db->dbprefix('order_menu_comment');
    
    //06/02/2017
    $this->_restaurants_location = $this->db->dbprefix('restaurants_location');
    $this->_restaurants_floor = $this->db->dbprefix('restaurants_floor');
    $this->_cinema_audi = $this->db->dbprefix('cinema_audi');
    
    $this->_threshold = $this->db->dbprefix('threshold');


    error_reporting(0);
  }

  public function takeOrderModule() { // old
    if (count($this->input->post()) >= 0) {
      $orderid = 1; //$this->input->post('orderid');
      $serverid = 1; //$this->input->post('serverid');

      $this->db->select('name, device_token');
      $staff_info = $this->db->get_where($this->_staff_member, array('id' => $serverid))->row();
      $staff_member_name = $staff_info->name;

      $result = $this->db->get_where($this->_order, array('order_id' => $orderid, 'staff_member_id' => 0));
      if ($result->num_rows() > 0) {
        $device_token = $staff_info->device_token;

        $this->db->where('order_id', $orderid);
        $this->db->update($this->_order, array('staff_member_id' => $serverid));

        require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
        $gcm = new Gcm();
        $msg = 'You assigned this order';

        echo $device_token;
        die();
        $gcm->sendNotification($device_token, $msg);

        $this->db->select('branch_id');
        $establishment_id = $this->db->get_where($this->_staff_member, array('id' => $serverid))->row()->branch_id;

        $this->db->select('device_token');
        $staff_qry = $this->db->get_where($this->_staff_member, array('id !=' => $serverid, 'branch_id' => $establishment_id, 'status' => 1));

        if ($staff_qry->num_rows() > 0) {
          require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
          $gcm = new Gcm();
          foreach ($staff_qry->result() as $sdata) {
            $sdevice_token = $sdata->device_token;
            $msg = '$staff_member_name assigned this order';
            $gcm->sendNotification($sdevice_token, $msg);
          }
        }
        return 1;
      } else
        return 0;
    } else
      return 0;
  }

  /* public function nudgeOrderModule()
    {
    if (count($this->input->post()) > 0)
    {
    $orderid  =  $this->input->post('orderid');

    $this->db->select($this->_staff_member.'.name, '.$this->_staff_member.'.device_token');
    $this->db->where($this->_order.'.order_id', $orderid);
    $this->db->from($this->_order);
    $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
    $staff_info = $this->db->get();

    if ($staff_info->num_rows() > 0)
    {
    $staff_member_data  = $staff_info->row();
    $staff_member_name  = $staff_member_data->name;
    $staff_member_token = $staff_member_data->device_token;

    $result = $this->db->get_where($this->_order, array('order_id' => $orderid, 'status !=' => 3));
    if ($result->num_rows() > 0)
    {
    $this->db->where('order_id', $orderid);
    $this->db->update($this->_order, array('status' => 2));

    require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
    $gcm  =  new Gcm();
    $msg  =  "This is a reminder from the customer for Order #$orderid. Please keep it under priority.&orderid=$orderid";
    $gcm->sendNotification($staff_member_token, $msg);

    return 1;
    }
    else
    return 0;
    }
    }
    else
    return 0;
    }
   */

  public function nudgeOrderModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');

      $dont_ask_nudge = (int) $this->input->post('dont_ask_nudge');

      if ($dont_ask_nudge == 1) {
        $customer_id = $this->db->select('customer_id')->get_where($this->_order, array('order_id' => $orderid))->row()->customer_id;
        $this->db->insert($this->_dont_ask_nudge, array('userid' => $customer_id, 'ttime' => time()));
      } else {
        $this->db->select($this->_staff_member . '.name, ' . $this->_staff_member . '.device_token, ' . $this->_order . '.status, ' . $this->_order . '.staff_member_id');
        $this->db->where(array($this->_order . '.order_id' => $orderid, $this->_order . '.status !=' => 3));
        $this->db->from($this->_order);
        $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
        $staff_info = $this->db->get();
        if ($staff_info->num_rows() > 0) {
          $data = $staff_info->row();
          $staff_member_name = $data->name;
          $staff_member_token = $data->device_token;
          $order_status = $data->status;
          if ($order_status != 5) {
            $this->db->where(array('order_id' => $orderid))->update($this->_order, array('status' => 2, 'nudge_flag_service_app' => 1));
            require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
            $gcm = new Gcm();
            $msg = "This is a reminder from the customer for Order #$orderid. Please keep it under priority.&orderid=$orderid";

            $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'serverid' => $data->staff_member_id, 'notification' => "This is a reminder from the customer for Order #$orderid. Please keep it under priority.", 'ttime' => time(), 'notify_status' => 1, 'flag' => 2));

            $gcm->sendNotification($staff_member_token, $msg);
            return 1;
          } else
            return 2;
        }
      }
    }
    return 0;
  }

  public function notificationOrdersModule() {
    $info = array();
    if (count($this->input->post()) > 0) {
      $serverid = (int) $this->input->post('serverid');

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      $this->db->select('order_id');
      $this->db->where(array('serverid' => $serverid, 'ttime >= ' => $start_time, 'ttime <= ' => $end_time));
      $query_notification = $this->db->get($this->_order_notification);
      if ($query_notification->num_rows() > 0) {
        foreach ($query_notification->result() as $sdata)
          $order_ids[] = $sdata->order_id;

        $this->db->where_in('order_id', $order_ids);
        $query = $this->db->get($this->_order);

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $sdata) {
            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();

            $this->db->select('menu_id, qty, complete');

            $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));

            $menu_item_array = array();

            foreach ($res_query->result() as $mid) {
              $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data

              $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

              $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

              $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

              $this->db->from($this->_menu_customization_type);

              $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

              $rs = $this->db->get();

              $customization_count = (int) $rs->num_rows();

              if ($customization_count > 0) {
                $options = array();
                foreach ($rs->result() as $rdata) {
                  $options['name'] = $rdata->customization_name;
                  $this->db->select('id, customization_type_id, option_name, price');
                  $opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
                  if ($opt_query->num_rows() > 0) {
                    foreach ($opt_query->result() as $odata) {
                      $options['options'][] = array('option_name' => $odata->option_name, 'price' => $odata->price);
                    }
                  }
                }

                $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'complete' => $mid->complete, 'customization' => $options);
              } else {
                $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => array());
              }
            }

            $payment_method = (int) $sdata->payment_method;

            switch ($payment_method) {
              case 1:
                $payment = "Credit Purchase";
                break;
              case 2:
                $payment = "Cash On Delivery";
                break;
              case 3:
                $payment = "Payu";
                break;
            }

            $order_res = array();

            //$this->db->select('notification');
            //$this->db->order_by('ttime', 'asc');
            //$this->db->where('notify_status', 1);
            //$this->db->or_where('notify_status', 2);


            $query_notification = $this->db->query("SELECT notification FROM $this->_order_notification WHERE order_id = " . $sdata->order_id . " AND (notify_status = 1 OR notify_status = 2) ORDER BY ttime ASC");

            //$query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
            if ($query_notification->num_rows() > 0) {
              foreach ($query_notification->result() as $res)
                $order_res[] = $res->notification;
            }

            $completion_time = ($sdata->completion_time != 0) ? date('D, j M Y h:i a', $sdata->completion_time) : '';
            $cancel_time = ($sdata->cancel_time != 0) ? date('D, j M Y h:i a', $sdata->cancel_time) : '';


            $info[] = array('orderid' => $sdata->order_id, 'completion_time' => $completion_time, 'cancel_time' => $cancel_time, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => getOrderLocationAndroid($sdata->location), 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status, 'notification' => $order_res);
          }
        }
      }
    }
    return $info;
  }

  public function deliveryInfoOrdersModule() {
    $info = array();
    if (count($this->input->post()) > 0) {
      $serverid = (int) $this->input->post('serverid');
      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));


      $this->db->where('serverid', $serverid)->delete($this->_delivery_intimation_count);

      // $this->db->select('GROUP_CONCAT(order_id) as orderid');

      $this->db->select('order_id');
      $this->db->where(array('serverid' => $serverid, 'ttime >= ' => $start_time, 'ttime <= ' => $end_time, 'delivery_info' => 1));
      $this->db->order_by('ttime', 'desc');

      $query_notification = $this->db->get($this->_order_notification);

      if ($query_notification->num_rows() > 0) {
        foreach ($query_notification->result() as $sdata)
          $order_ids[] = $sdata->order_id;

        $this->db->where_in('order_id', array_unique($order_ids));
        $this->db->where('status !=', 3);
        $this->db->where('status !=', 4);

        $this->db->order_by('order_time', 'desc');

        $query = $this->db->get($this->_order);

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $sdata) {

            /* Get Comments */
            $comments = '';
            $random_qry = $this->db->select('comment')->get_where($this->_order_comment, array('randomid' => $sdata->randomid));
            if ($random_qry->num_rows() > 0)
              $comments = $random_qry->row()->comment;


            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();

            $this->db->select('menu_id, qty, complete');

            $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));

            $menu_item_array = array();

            foreach ($res_query->result() as $mid) {
              $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data

              $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

              $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

              $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

              $this->db->from($this->_menu_customization_type);

              $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

              $rs = $this->db->get();

              $customization_count = (int) $rs->num_rows();

              if ($customization_count > 0) {
                $options = array();
                foreach ($rs->result() as $rdata) {
                  $options['name'] = $rdata->customization_name;
                  $this->db->select('id, customization_type_id, option_name, price');
                  $opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
                  if ($opt_query->num_rows() > 0) {
                    foreach ($opt_query->result() as $odata) {
                      $options['options'][] = array('option_name' => $odata->option_name, 'price' => $odata->price);
                    }
                  }
                }

                $menu_item_array[] = array('id' => $result->id, 'oid' => $sdata->order_id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => $options);
              } else {
                $menu_item_array[] = array('id' => $result->id, 'oid' => $sdata->order_id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => array());
              }
            }

            $payment_method = (int) $sdata->payment_method;

            switch ($payment_method) {
              case 1:
                $payment = "Credit Purchase";
                break;
              case 2:
                $payment = "Cash On Delivery";
                break;
              case 3:
                $payment = "Payu";
                break;
            }

            $info[] = array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => getOrderLocationAndroid($sdata->location), 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status, 'comments' => $comments);
          }
        }
      }
    }
    return $info;
  }

  public function deliveryInformationHistoryModule() {
    $info = array();
    if (count($this->input->post()) > 0) {
      $serverid = (int) $this->input->post('serverid');

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      $query_notification = $this->db->query("SELECT order_id FROM " . $this->_order_notification . " WHERE serverid = $serverid AND ttime >= $start_time AND ttime <= $end_time AND (flag = 6 OR flag = 3)");

      if ($query_notification->num_rows() > 0) {
        foreach ($query_notification->result() as $rdata)
          $order_id_arr[] = $rdata->order_id;

        $this->db->where_in('order_id', $order_id_arr);
        $query = $this->db->get($this->_order);

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $sdata) {
            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();

            $this->db->select('menu_id, qty, complete');

            $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));

            $menu_item_array = array();

            foreach ($res_query->result() as $mid) {
              $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data

              $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

              $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

              $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

              $this->db->from($this->_menu_customization_type);

              $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

              $rs = $this->db->get();

              $customization_count = (int) $rs->num_rows();

              if ($customization_count > 0) {
                $options = array();
                foreach ($rs->result() as $rdata) {
                  $options['name'] = $rdata->customization_name;
                  $this->db->select('id, customization_type_id, option_name, price');
                  $opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
                  if ($opt_query->num_rows() > 0) {
                    foreach ($opt_query->result() as $odata) {
                      $options['options'][] = array('option_name' => $odata->option_name, 'price' => $odata->price);
                    }
                  }
                }

                $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => $options);
              } else {
                $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => array());
              }
            }

            $payment_method = (int) $sdata->payment_method;

            switch ($payment_method) {
              case 1:
                $payment = "Credit Purchase";
                break;
              case 2:
                $payment = "Cash On Delivery";
                break;
              case 3:
                $payment = "Payu";
                break;
            }

            $order_res = array();

            $this->db->select('notification');
            $this->db->order_by('ttime', 'asc');
            $query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
            if ($query_notification->num_rows() > 0) {
              foreach ($query_notification->result() as $res)
                $order_res[] = $res->notification;
            }

            $info[] = array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => getOrderLocationAndroid($sdata->location), 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status, 'notification' => $order_res);
          }
        }
      }
    }
    return $info;
  }

  public function userProfileModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');

      $this->db->select('customer_id');
      $result = $this->db->get_where($this->_order, array('order_id' => $orderid))->row();
      $customer_id = $result->customer_id;

      $this->db->select('name, email, contactno, pic');
      $cinfo = $this->db->get_where($this->_users, array('id' => $customer_id))->row();

      return array('name' => (string) $cinfo->name, 'email' => (string) $cinfo->email, 'mobile' => $cinfo->contactno, 'pic' => (string) $cinfo->pic);
    } else
      return array();
  }

  public function nudgeReplyModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');
      $serverid = $this->input->post('serverid');
      $message = $this->input->post('message');

      /* $this->db->select('customer_id');
        $result = $this->db->get_where($this->_order, array('order_id' => $orderid))->row();
        $customer_id  =  $result->customer_id;

        $this->db->select('device_token');
        $device_token = $this->db->get_where($this->_users, array('id' => $customer_id))->row()->device_token;
       */

      $this->db->select($this->_accounts . '.device_token');
      $this->db->where($this->_order . '.order_id', $orderid);
      $this->db->from($this->_accounts);
      $this->db->join($this->_order, "$this->_order.customer_id  = $this->_accounts.id");
      $device_token = $this->db->get()->row()->device_token;

      if (!empty($device_token)) {
        $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'serverid' => $serverid, 'notification' => $message, 'ttime' => time(), 'notify_status' => 2, 'flag' => 1));

        require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
        Push::send_notification_ios(array($device_token), $message);
      }
    } else
      return 0;
  }

  public function serverTakeOrderModule() {
    if (count($this->input->post()) > 0) {
      $orderid = (int) $this->input->post('orderid');
      $serverid = (int) $this->input->post('serverid');

      $result = $this->db->get_where($this->_order, array('order_id' => $orderid, 'staff_member_id' => 0));
      if ($result->num_rows() > 0) {
        /* Send Notification To User */

        /* Get User Device Token */
        $this->db->select($this->_accounts . '.device_token');
        $this->db->where($this->_order . '.order_id', $orderid);
        $this->db->from($this->_accounts);
        $this->db->join($this->_order, "$this->_order.customer_id  = $this->_accounts.id");
        $customer_qry = $this->db->get();
        if ($customer_qry->num_rows() > 0) {
          $device_token = $customer_qry->row()->device_token;
          require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
          $omsg = "Order accepted and will be delivered shortly.";
          Push::send_notification_ios(array($device_token), array('message' => $omsg, 'orderid' => $orderid));
          $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'notification' => $omsg, 'ttime' => time(), 'flag' => 1, 'notify_status' => 7));
        }

        /* Close User Notification */

        /* Send Notification */

        $staff_info = $this->db->select('device_token')->get_where($this->_staff_member, array('id' => $serverid))->row();
        $device_token = $staff_info->device_token;

        $this->db->where('order_id', $orderid)->update($this->_order, array('order_accept_time' => time(), 'staff_member_id' => $serverid, 'pending_order_flag' => 1));
        require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
        $gcm = new Gcm();
        $msg = "New Order Accepted! Upon delivery, please mark the order as \"Complete\"&orderid=$orderid";
        $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'notification' => "New Order #$orderid Accepted", 'ttime' => time(), 'flag' => 2, 'notify_status' => 7));
        $gcm->sendNotification($device_token, $msg);

        return 1;
      } else
        return 0;
    } else
      return 0;
  }

  public function serverCancelledOrderModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');

      $checkstatus = $this->db->select('status')->where('order_id', $orderid)->get($this->_order)->row()->status;

      if ($checkstatus != 4) {
        $this->db->where('order_id', $orderid)->update($this->_order, array('status' => 4, 'cancel_time' => time()));

        /* Order Cancel Reason */

        $flag = (int) $this->input->post('flag');
        $reason = '';

        switch ($flag) {
          case 1:
            $reason = "User was not present at the location";
            break;
          case 2:
            $reason = "User did not accept the order";
            break;

          case 3:
            $reason = "Staff did not prepare the right order";
            break;

          case 4:
            $reason = "Fake order placed";
            break;

          case 5:
            $reason = $this->input->post('cancel_reason');
            break;
        }

        $data['reason'] = $reason;
        $data['order_id'] = $orderid;
        $data['ctime'] = time();
        $data['server_flag'] = 1;
        $this->db->insert($this->_order_cancel_reason, $data);

        /* Send cancel order mail to user */

        $this->db->select($this->_accounts . ".email, " . $this->_accounts . ".contactno, " . $this->_accounts . ".device_token");
        $this->db->where($this->_order . '.order_id', $orderid);
        $this->db->from($this->_order);
        $this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
        $cqry = $this->db->get()->row();

        $email = $cqry->email;
        $contactno = $cqry->contactno;
        $device_token = $cqry->device_token;

        $msg = "Order #$orderid has been cancelled due to the following reason(s): $reason";

        $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'notification' => $msg, 'ttime' => time(), 'flag' => 1, 'notify_status' => 9));

        require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
        Push::send_notification_ios(array($device_token), array('message' => "$msg"));

        if (!empty($email)) {
          $this->email->from(config_item('from_email'), config_item('from_name'));
          $this->email->to($email);
          $this->email->subject('AFewTaps - Order Cancel');
          $this->email->message($msg);
          $this->email->send();
        }

        /* close email */

        /* Send SMS */

        if (!empty($contactno)) {
          require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Sms.php');
          Sms::sendMessage($contactno, $msg);
        }

        return 1;
      } else
        return 0;
    } else
      return 0;
  }

  public function serverOrderDeliveryTimeModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');
      $serverid = $this->input->post('serverid');
      $msg = $this->input->post('msg');

      $this->db->select('customer_id');
      $result = $this->db->get_where($this->_order, array('order_id' => $orderid))->row();
      $customer_id = $result->customer_id;

      $message = array('message' => $msg, 'title' => 'Order Delivery Time');

      $this->db->select('device_token');
      $device_token = $this->db->get_where($this->_users, array('id' => $customer_id))->row()->device_token;

      if (!empty($device_token)) {
        $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'serverid' => $serverid, 'notification' => $message['message'], 'ttime' => time(), 'delivery_info' => 1, 'notify_status' => 2, 'flag' => 2));

        require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
        Push::send_notification_ios(array($device_token), $message);
        return 1;
      }
    } else
      return 0;
  }

  public function deliverInformationModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');

      $this->db->select('establishment_id, customer_id, staff_member_id');
      $result = $this->db->get_where($this->_order, array('order_id' => $orderid))->row();
      $establishment_id = $result->establishment_id;
      $customer_id = $result->customer_id;
      $serverid = $result->staff_member_id;

      //$staff_member_name =  $this->db->select('name')->get_where($this->_staff_member, array('id' => $serverid))->row()->name;

      $info = $this->db->select('info')->get_where($this->_payment_method, array('branch_id' => $establishment_id))->row()->info;

      $this->db->where('order_id', $orderid)->update($this->_order, array('delivery_intimation' => 1));

      if ($info == 1)
        $message = array('message' => "Attention! Your order is ready and on its way. This establishment does not support table delivery.");
      else
        $message = array('message' => "Attention! Your order is ready and on its way. Please make sure you are at your desired location to receive it. Thank you.");

      $device_token = $this->db->select('device_token')->get_where($this->_accounts, array('id' => $customer_id))->row()->device_token;

      $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'serverid' => $serverid, 'notification' => $message['message'], 'ttime' => time(), 'delivery_info' => 1, 'flag' => 1, 'notify_status' => 6));


      $count = 1;
      $query = $this->db->select('count')->where('serverid', $serverid)->get($this->_delivery_intimation_count);
      if ($query->num_rows() > 0) {
        $count = $query->row()->{'count'};
        $count = $count + 1;
        $this->db->where('serverid', $serverid)->update($this->_delivery_intimation_count, array('count' => $count));
      } else
        $this->db->insert($this->_delivery_intimation_count, array('serverid' => $serverid, 'count' => 1));


      if (!empty($device_token)) {
        require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
        Push::send_notification_ios(array($device_token), $message);
      }
      return "$count";
    } else
      return "0";
  }

  public function cmsContent($pageid = '') {
    return $this->db->select('description')->get_where($this->_service_cms, array('page_id' => $pageid))->row()->description;
  }

  public function getOrderDeliveredModule() {
    if (count($this->input->post()) > 0) {
      $orderid = $this->input->post('orderid');
      $this->db->where('order_id', $orderid)->update($this->_order, array('status' => 3, 'completion_time' => time()));
      $amount = $this->db->select('total_amount')->get_where($this->_order, array('order_id' => $orderid))->row()->total_amount;

      $this->db->where('order_id', $orderid)->update($this->_order, array('delivery_intimation' => 0));

      /* Send Notification */

      $msg = "Thank you for using afewtaps. Your order #$orderid amounting to Rs. $amount has been successfully delivered.";

      $serverid = $this->db->select('staff_member_id')->get_where($this->_order, array('order_id' => $orderid))->row()->staff_member_id;

      $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'serverid' => $serverid, 'notification' => $msg, 'ttime' => time(), 'flag' => 1, 'notify_status' => 8));

      $this->db->select($this->_accounts . '.device_token');
      $this->db->where($this->_order . '.order_id', $orderid);
      $this->db->from($this->_accounts);
      $this->db->join($this->_order, "$this->_order.customer_id = $this->_accounts.id");
      $customer_qry = $this->db->get();
      if ($customer_qry->num_rows() > 0) {
        $device_token = $customer_qry->row()->device_token;
        if (!empty($device_token)) {
          require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
          Push::send_notification_ios(array($device_token), array('message' => $msg));
        }
      }

      return $orderid;
    } else
      return 0;
  }

  public function getAllOrdersModule() {
      
    $info = array();
    if (count($this->input->post()) > 0) {
      $serverid = (int) $this->input->post('serverid');
      $status = $this->input->post('status');
      $notification = (int) $this->input->post('notification');
      $status_arr = explode(',', $status);

      $establishmentid = $this->db->select('branch_id')->get_where($this->_staff_member, array('id' => $serverid))->row()->branch_id;
      
      $this->db->select('order_id, customer_id, location, total_amount, staff_member_id, order_time, payment_method, status, randomid, order_accept_time, so_order_time');

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      // $this->db->order_by('order_time', 'desc');

      if (count($status_arr) > 1) {
        $this->db->where_in('status', $status_arr);
        $this->db->where(array('establishment_id' => $establishmentid, 'staff_member_id' => $serverid, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));
      } else
        $this->db->where(array('establishment_id' => $establishmentid, 'staff_member_id' => $serverid, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time, 'status' => $status));

      $query = $this->db->get($this->_order);

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $sdata) {
          /* Get Comments */
          $comments = '';
          $random_qry = $this->db->select('comment')->get_where($this->_order_comment, array('randomid' => $sdata->randomid));
          if ($random_qry->num_rows() > 0)
            $comments = $random_qry->row()->comment;
          if($sdata->customer_id > 0){
            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();
          }
          else{
            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row();
          }
          

          $this->db->select('menu_id, qty, complete');

          $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));

          $menu_item_array = array();

          foreach ($res_query->result() as $mid) {
            $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
            $comment_menu = $this->db->get_where($this->_order_menu_comment, array('order_menu_id' => $mid->menu_id, 'order_id' => $sdata->order_id))->row(); // Menu comment

            $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

            $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

            $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

            $this->db->from($this->_menu_customization_type);

            $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

            $rs = $this->db->get();
            $customization_count = (int) $rs->num_rows();

            if ($customization_count > 0) {
              $options = array();
              $i=1;
              $options = array();
              
              foreach ($rs->result() as $rdata) {
                  
                $optionsss['name'] = $rdata->customization_name;
                $qrry = "select * from ft_order_menu_customization_options as fomco "
                        . "LEFT JOIN ft_menu_customization_options as fmco on fmco.id=fomco.customization_options "
                        . "Where fomco.order_id='$sdata->order_id' and fomco.order_menu_id='$mid->menu_id' "
                        . "and fmco.customization_type_id='$rdata->customization_type_id' ";
                $opt_query = $this->db->query($qrry);
                
                if ($opt_query->num_rows() > 0) {
                    $optionsss['options'] = array();
                  foreach ($opt_query->result() as $odata) {
                      
                    $optionsss['options'][]=array('option_name'=> $odata->option_name,'price'=> $odata->price);
                  }
                  $options[] = $optionsss;
                }
                ++$i;
              }

              $menu_item_array[] = array(
                    'id' => $result->id,
                    'oid' => $sdata->order_id,
                    'desc' => $result->description,
                    'item' => $result->item_name,
                    'price' => $result->price,
                    'qty' => $mid->qty,
                    'complete' => $mid->complete,
                    'type' => $result->item_type,
                    'customization' => $options,
                    'comment_menu' => $comment_menu
                  );
            } else {
              $menu_item_array[] = array(
                  'id' => $result->id,
                  'oid' => $sdata->order_id,
                  'desc' => $result->description,
                  'item' => $result->item_name,
                  'price' => $result->price,
                  'qty' => $mid->qty,
                  'complete' => $mid->complete,
                  'type' => $result->item_type,
                  'customization' => array(),
                  'comment_menu' => $comment_menu
                      );
            }
          }

          $payment_method = (int) $sdata->payment_method;

          switch ($payment_method) {
            case 1:
              $payment = "Credit Purchase";
              break;
            case 2:
              $payment = "Cash On Delivery";
              break;
            case 3:
              $payment = "Payu";
              break;
          }

          $order_res = array();

          if ($notification > 0) {
            $this->db->select('notification');
            $this->db->order_by('ttime', 'asc');
            $query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
            if ($query_notification->num_rows() > 0) {
              foreach ($query_notification->result() as $res)
                $order_res[] = $res->notification;
            }
          }

          $flag = 1;
          if (count($status_arr) > 1) {
            if (($sdata->new_flag_service_app == 0) OR ( $sdata->nudge_flag_service_app == 1) OR ( $sdata->escalation_flag_service_app == 1)) {
              $flag = 0;
              $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('new_flag_service_app' => 1, 'nudge_flag_service_app' => 0, 'escalation_flag_service_app' => 0));
            }
          } elseif ($status == 2) {
            if ($sdata->nudge_flag_service_app == 1)
              $flag = 0;
            $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('nudge_flag_service_app' => 0));
          }
          else {
            if ($sdata->escalation_flag_service_app == 1)
              $flag = 0;
            $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('escalation_flag_service_app' => 0));
          }

          $ttime = empty($sdata->order_accept_time) ? $sdata->order_time : $sdata->order_accept_time;

          $info[] = array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => getOrderLocationAndroid($sdata->location), 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status, 'notification' => $order_res, 'comments' => $comments, 'flag' => $flag, 'ttime' => $ttime,'so_order_time'=>$sdata->so_order_time);
        }

        $response = array();
        foreach ($info as $key => $row) {
          $response[$key] = $row['ttime'];
        }
        array_multisort($response, SORT_DESC, $info);
      }
    }
    return $info;
  }
  public function orderHistoryModule($serverId,$limit,$offset) {
        $serverid = (int) $serverId;
        $info = array();

      $establishmentid = $this->db->select('branch_id')->get_where($this->_staff_member, array('id' => $serverid))->row()->branch_id;
      
      $this->db->select('order_id, customer_id, location, total_amount, staff_member_id, order_time, payment_method, status, randomid, order_accept_time, so_order_time');

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      // $this->db->order_by('order_time', 'desc');

      if (count($status_arr) > 1) {
        $where = "establishment_id = '$establishmentid' and  staff_member_id='$serverid' and status IN (3,4) ";
        $this->db->where($where);
        $this->db->order_by('order_id', 'DESC');
        $this->db->limit($limit,$offset);
      } else {
        $where = "establishment_id = '$establishmentid' and  staff_member_id='$serverid' and status IN (3,4) ";
        $this->db->where($where);
        $this->db->order_by('order_id', 'DESC');            
        $this->db->limit($limit,$offset);
      }
      $query = $this->db->get($this->_order);
      if ($query->num_rows() > 0) {
        foreach ($query->result() as $sdata) {
          /* Get Comments */
          $comments = '';
          $random_qry = $this->db->get_where($this->_order_comment, array('randomid' => $sdata->randomid));
          if ($random_qry->num_rows() > 0)
            $comments = $random_qry->row()->comment;
          if($sdata->customer_id > 0){
            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();
          }
          else{
            $this->db->select('name');
            $customer_info = $this->db->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row();
          }
          

          $this->db->select('menu_id, qty, complete');

          $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));

          $menu_item_array = array();

          foreach ($res_query->result() as $mid) {
            $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
            $comment_menu = $this->db->get_where($this->_order_menu_comment, array('order_menu_id' => $mid->menu_id, 'order_id' => $sdata->order_id))->row(); // Menu comment

            $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

            $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

            $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

            $this->db->from($this->_menu_customization_type);

            $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

            $rs = $this->db->get();
//            echo $this->db->last_query();
//            die();
            $customization_count = (int) $rs->num_rows();

            if ($customization_count > 0) {
              $i=1;
              $options = array();
              
              foreach ($rs->result() as $rdata) {
                  
                $optionsss['name'] = $rdata->customization_name;
                $qrry = "select * from ft_order_menu_customization_options as fomco "
                        . "LEFT JOIN ft_menu_customization_options as fmco on fmco.id=fomco.customization_options "
                        . "Where fomco.order_id='$sdata->order_id' and fomco.order_menu_id='$mid->menu_id' "
                        . "and fmco.customization_type_id='$rdata->customization_type_id' ";
                $opt_query = $this->db->query($qrry);
//                echo $this->db->last_query();die();
//                $this->db->select('id, customization_type_id, option_name, price');
//                $opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
                
                if ($opt_query->num_rows() > 0) {
                    $optionsss['options'] = array();
                  foreach ($opt_query->result() as $odata) {
                      
                    $optionsss['options'][]=array('option_name'=> $odata->option_name,'price'=> $odata->price);
                  }
                  $options[] = $optionsss;
                }
                ++$i;
              }

              $menu_item_array[] = array(
                    'id' => $result->id,
                    'oid' => $sdata->order_id,
                    'desc' => $result->description,
                    'item' => $result->item_name,
                    'price' => $result->price,
                    'qty' => $mid->qty,
                    'complete' => $mid->complete,
                    'type' => $result->item_type,
                    'customization' => $options,
                    'comment_menu' => $comment_menu
                  );
            } else {
              $menu_item_array[] = array(
                  'id' => $result->id,
                  'oid' => $sdata->order_id,
                  'desc' => $result->description,
                  'item' => $result->item_name,
                  'price' => $result->price,
                  'qty' => $mid->qty,
                  'complete' => $mid->complete,
                  'type' => $result->item_type,
                  'customization' => array(),
                  'comment_menu' => $comment_menu
                      );
            }
          }

          $payment_method = (int) $sdata->payment_method;

          switch ($payment_method) {
            case 1:
              $payment = "Credit Purchase";
              break;
            case 2:
              $payment = "Cash On Delivery";
              break;
            case 3:
              $payment = "Payu";
              break;
          }

          $order_res = array();

          if ($notification > 0) {
            $this->db->select('notification');
            $this->db->order_by('ttime', 'asc');
            $query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
            if ($query_notification->num_rows() > 0) {
              foreach ($query_notification->result() as $res)
                $order_res[] = $res->notification;
            }
          }

          $flag = 1;
          if (count($status_arr) > 1) {
            if (($sdata->new_flag_service_app == 0) OR ( $sdata->nudge_flag_service_app == 1) OR ( $sdata->escalation_flag_service_app == 1)) {
              $flag = 0;
              $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('new_flag_service_app' => 1, 'nudge_flag_service_app' => 0, 'escalation_flag_service_app' => 0));
            }
          } elseif ($status == 2) {
            if ($sdata->nudge_flag_service_app == 1)
              $flag = 0;
            $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('nudge_flag_service_app' => 0));
          }
          else {
            if ($sdata->escalation_flag_service_app == 1)
              $flag = 0;
            $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('escalation_flag_service_app' => 0));
          }

          $ttime = empty($sdata->order_accept_time) ? $sdata->order_time : $sdata->order_accept_time;

          $info[] = array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => getOrderLocationAndroid($sdata->location), 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status, 'notification' => $order_res, 'comments' => $comments, 'flag' => $flag, 'ttime' => $ttime,'so_order_time'=>$sdata->so_order_time);
        }

        $response = array();
        foreach ($info as $key => $row) {
          $response[$key] = $row['ttime'];
        }
        array_multisort($response, SORT_DESC, $info);
      }
    return $info;
  }

  public function getOrders() {
    $info = array();
    if (count($this->input->post()) > 0) {
      $serverid = (int) $this->input->post('id');
      //$limit      =  (int) $this->input->post('limit');
      $this->db->select('branch_id');
      $establishmentid = $this->db->get_where($this->_staff_member, array('id' => $serverid))->row()->branch_id;

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      $this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, randomid, new_flag_service_app, escalation_flag_service_app');
      $this->db->order_by('order_time', 'desc');

      //$this->db->limit(5, $limit);

      $query = $this->db->get_where($this->_order, array('staff_member_id' => 0, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time, 'establishment_id' => $establishmentid, 'status !=' => 4));

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $sdata) {

          /* Get Comments */
          $comments = '';
          $random_qry = $this->db->select('comment')->get_where($this->_order_comment, array('randomid' => $sdata->randomid));
          if ($random_qry->num_rows() > 0)
            $comments = $random_qry->row()->comment;

          /* End Here */

          $this->db->select('name');
          $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();

          $this->db->select('menu_id, qty, complete');

          $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));

          $menu_item_array = array();

          foreach ($res_query->result() as $mid) {
            $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
            $comment = $this->db->get_where($this->_order_menu_comment, array('order_menu_id' => $mid->menu_id, 'order_id' => $sdata->order_id))->row(); // Menu comment


            $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

            $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

            $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

            $this->db->from($this->_menu_customization_type);

            $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

            $rs = $this->db->get();

            $customization_count = (int) $rs->num_rows();

            if ($customization_count > 0) {
                
                
              $options = array();
              $i=1;
              foreach ($rs->result() as $rdata) {
                $optionsss['name'] = $rdata->customization_name;
                
//                $this->db->select('id, customization_type_id, option_name, price');
//                $opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
                $qrry = "select * from ft_order_menu_customization_options as fomco "
                        . "LEFT JOIN ft_menu_customization_options as fmco on fmco.id=fomco.customization_options "
                        . "Where fomco.order_id='$sdata->order_id' and fomco.order_menu_id='$mid->menu_id' "
                        . "and fmco.customization_type_id='$rdata->customization_type_id' ";
                $opt_query = $this->db->query($qrry);
                if ($opt_query->num_rows() > 0) {
                    $optionsss['options'] = array();
                  foreach ($opt_query->result() as $odata) {
//                    $options['options'][] = array('option_name' => $odata->option_name, 'price' => $odata->price);
                      $optionsss['options'][]=array('option_name'=> $odata->option_name,'price'=> $odata->price);
                  }
                  $options[] = $optionsss;
                }
                ++$i;
              }

              $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => $options, 'comment' => $comment);
            } else {
              $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => array(), 'comment' => $comment);
            }
          }

          $payment_method = (int) $sdata->payment_method;

          switch ($payment_method) {
            case 1:
              $payment = "Credit Purchase";
              break;
            case 2:
              $payment = "Cash On Delivery";
              break;
            case 3:
              $payment = "Payu";
              break;
          }
            $str_time = date('H:i:s',strtotime($sdata->order_time));
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
//            echo "Hours = ".$hours."<br>";
//            echo "Minutes = ".$minutes."<br>";
//            echo "Seconds = ".$seconds."<br>";
//            echo "order time in sec only = ";
            $otime_in_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
          $info[] = array(
                    'orderid' => $sdata->order_id,
                    'payment_method' => $payment, 
                    'name' => $customer_info->name, 
                    'location' => getOrderLocationAndroid($sdata->location),
                    'otime' => date('h:i a, d M Y', $sdata->order_time),
                    'so_order_time' => "$otime_in_seconds",
                    'price' => $sdata->total_amount,
                    'menu' => $menu_item_array,
                    'status' => $sdata->status,
                    'comments' => $comments,
                    'flag' => $sdata->new_flag_service_app,
                    'escalated' => $sdata->escalation_flag_service_app
                  );
          $this->db->where('order_id', $sdata->order_id)->update($this->_order, array('new_flag_service_app' => 1));
        }
      }
    }
    return $info;
  }

  public function reminderOrderModule() {
    $info = array();
    $order_res = array();
    if (count($this->input->post()) > 0) {
      $serverid = (int) $this->input->post('serverid');

      $this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status');

      $this->db->order_by('order_time', 'desc');

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      $query = $this->db->get_where($this->_order, array('status' => 2, 'staff_member_id' => $serverid, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));

      $menu_item_array = array();

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $sdata) {
          $this->db->select('name');
          $customer_info = $this->db->get_where($this->_users, array('id' => $sdata->customer_id))->row();
          $this->db->select('menu_id, qty, complete');
          $res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
          foreach ($res_query->result() as $mid) {
            $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data

            $this->db->select($this->_menu_customization_type . '.id, ' . $this->_menu_customization_type . '.customization_name, ' . $this->_order_menu_customization_type . '.customization_type_id');

            $this->db->where($this->_order_menu_customization_type . '.order_menu_id', $mid->menu_id);

            $this->db->where($this->_order_menu_customization_type . '.order_id', $sdata->order_id);

            $this->db->from($this->_menu_customization_type);

            $this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");

            $rs = $this->db->get();

            $customization_count = (int) $rs->num_rows();

            if ($customization_count > 0) {
              $options = array();
              foreach ($rs->result() as $rdata) {
                $options['name'] = $rdata->customization_name;
                $this->db->select('id, customization_type_id, option_name, price');
                $opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
                if ($opt_query->num_rows() > 0) {
                  foreach ($opt_query->result() as $odata) {
                    $options['options'][] = array('option_name' => $odata->option_name, 'price' => $odata->price);
                  }
                }
              }

              $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => $options);
            } else {
              $menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => array());
            }
          }

          $payment_method = (int) $sdata->payment_method;

          switch ($payment_method) {
            case 1:
              $payment = "Credit Purchase";
              break;
            case 2:
              $payment = "Cash On Delivery";
              break;
            case 3:
              $payment = "Payu";
              break;
          }

          $info[] = array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status);
        }
      }
      $establishmentid = $this->db->get_where($this->_staff_member, array('id' => $serverid))->row()->branch_id;

      $query = $this->db->select('order_id')->get_where($this->_order, array('establishment_id' => $establishmentid, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));
      if ($query->num_rows() > 0) {
        foreach ($query->result() as $ndata)
          $oid[] = $ndata->order_id;

        $query_notification = $this->db->query("SELECT notification FROM $this->_order_notification WHERE order_id IN (" . implode(',', $oid) . ") AND notify_status IN(1,3) ORDER BY ttime DESC");
        if ($query_notification->num_rows() > 0) {
          foreach ($query_notification->result() as $res)
            $order_res[] = $res->notification;
        }
      }
    }
    return array('orders' => $info, 'notification' => $order_res);
  }

  public function signInModule() {
    $msg = "";
    if (count($this->input->post()) > 0) {
      $email_contact_no = trim($this->input->post('email_contact_no'));
      $pwd = sha1(trim($this->input->post('pwd')));
      $sql = "SELECT id FROM " . $this->_staff_member . " WHERE (email_id = ? OR contact_no = ?) AND status = ?";
      $query = $this->db->query($sql, array($email_contact_no, $email_contact_no, 1));
      if ($query->num_rows() > 0) {
        $sql = "SELECT id FROM " . $this->_staff_member . " WHERE (email_id = ? OR contact_no = ?) AND password = ? AND status = ?";
        $query = $this->db->query($sql, array($email_contact_no, $email_contact_no, $pwd, 1));
        if ($query->num_rows() > 0) {
          $id = (int) $query->row()->id;
          $device_token = $this->input->post('device_token');
          $this->db->where('id', $id)->update($this->_staff_member, array('device_token' => $device_token, 'onlinestatus' => 1));

          $msg = array("success" => $id, "msg" => "Successfully login");
        } else {
          $msg = array("success" => 0, "msg" => "Wrong username or password");
        }
      } else {
        $msg = array("success" => 0, "msg" => "You are not registered,please sign up with you account details");
      }
    } else {
      $msg = array("success" => 0, "msg" => "Validation Error");
    }
    return $msg;
  }

  public function signUpModule($email = '') {
    $this->db->where('email_id', $email);
    $pwd = sha1($this->input->post('pwd'));
    $this->db->update($this->_staff_member, array('status' => 1, 'password' => $pwd));
    return $this->db->affected_rows();
  }

  public function saveSmsInfo($mobile = '', $uid = '', $email = '') {
    $this->db->where('email_id', $email);
    $pwd = sha1($this->input->post('pwd'));
    $device_token = $this->input->post('device_token');
    $this->db->update($this->_staff_member, array('password' => $pwd, 'device_token' => $device_token));

    $this->db->where('userid', $uid);
    $this->db->delete($this->_staff_sms_codes); // changed

    $otp = rand(100000, 999999);
    $data['userid'] = $uid;
    $data['code'] = $otp;
    $this->db->insert($this->_staff_sms_codes, $data); //changed

    return $this->sendSmsDataToUser($otp, $mobile);
  }

  public function serviceGcmId($gcm_reg_id = '', $flag = '', $userid = '') {
    switch ($flag) {
      case 1:
        $this->db->where('userid', $userid);
        $this->db->delete($this->_service_gcm);

        $data['userid'] = $userid;
        $data['gcm_reg_id'] = $gcm_reg_id;
        $data['ttime'] = time();
        $this->db->insert($this->_service_gcm, $data);

        break;

      case 2:
        $this->db->where('userid', $userid);
        $this->db->delete($this->_service_gcm);
        break;
    }
  }

  public function resendOtp($mobile = '', $uid = '') {
    $this->db->where('userid', $uid);
    $this->db->delete($this->_staff_sms_codes);

    $otp = rand(100000, 999999);
    $data['userid'] = $uid;
    $data['code'] = $otp;
    $this->db->insert($this->_staff_sms_codes, $data);

    return $this->sendSmsDataToUser($otp, $mobile);
  }

  public function sendSmsDataToUser($otp = '', $contactno = '', $message = '') {
    $url = "http://XLIM.msg4all.com/GatewayAPI/rest?method=SendMessage&send_to=91" . $contactno . "&msg=Welcome%20to%20afewtaps.%20Your%20OTP%20is%20" . $otp . "&msg_type=TEXT&loginid=afew123&auth_scheme=plain&password=xlim2016fewtap&v=1.1&format=text";

    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);
    return 1;
  }

  public function verifyOtpModule() {
    $otp = $this->input->get_post('otp');
    $this->db->where('code', $otp);
    $query = $this->db->get($this->_staff_sms_codes);
    $device_token = $this->input->post('device_token');
    if ($query->num_rows() > 0) {
      $result = $query->row();
      $userid = $result->userid;
      $emailid = $this->db->select('email_id')->get_where($this->_staff_member, array('id' => $userid))->row()->email_id;

      $this->db->where('code', $otp);
      $this->db->update($this->_staff_sms_codes, array('status' => 1));

      $this->db->where('id', $userid);
      $this->db->update($this->_staff_member, array('status' => 1, 'onlinestatus' => 1, 'device_token' => $device_token));


      //$this->serviceGcmId($gcm_reg_id, 1, $userid);

      $this->email->from(config_item('from_email'), config_item('from_name'));
      $this->email->to($emailid);
      $this->email->subject('AFewTaps - Sign Up');
      $this->email->message("Thank you for downloading afewtaps!");
      $this->email->send();

      return $userid;
    } else
      return;
  }

  public function showProfileModule() {
    if (count($this->input->post()) > 0) {
      $id = $this->input->post('id');
      $this->db->select('name, contact_no, pic, onlinestatus');
      $res = $this->db->get_where($this->_staff_member, array('id' => $id))->row();

      $start_time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $end_time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

      $completed_orders = (int) $this->db->get_where($this->_order, array('staff_member_id' => $id, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'status' => 3))->num_rows();
      $cancelled_orders = (int) $this->db->get_where($this->_order, array('staff_member_id' => $id, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'status' => 4))->num_rows();

      $total_orders = $completed_orders + $cancelled_orders;

      return array('name' => (string) $res->name, 'contactno' => $res->contact_no, 'pic' => (string) $res->pic, 'orders' => $total_orders, 'completed_orders' => $completed_orders, 'cancelled_orders' => $cancelled_orders, 'status' => $res->onlinestatus);
    }
    return;
  }

  public function changeStatusOnOffLineModule() {
    if (count($this->input->post()) > 0) {
      $id = $this->input->post('id');
      $onlinestatus = $this->input->post('onlinestatus');
      $this->db->where('id', $id)->update($this->_staff_member, array('onlinestatus' => $onlinestatus));
      return $this->db->affected_rows();
    }
    return;
  }

  public function serverLogoutModule() {
    if (count($this->input->post()) > 0) {
      $id = $this->input->post('id');
      $this->db->where('id', $id)->update($this->_staff_member, array('onlinestatus' => 0, 'device_token' => ''));
      return $this->db->affected_rows();
    }
    return 0;
  }

  public function forgotPwdModule($mobileno = '') {
    $this->db->select('id');
    $userid = (int) $this->db->get_where($this->_staff_member, array('contact_no' => $mobileno))->row()->{'id'};
    //return $this->saveSmsInfo($userid, $mobileno);

    $otp = rand(100000, 999999);
    $data['userid'] = $userid;
    $data['code'] = $otp;
    $this->db->insert($this->_staff_sms_codes, $data);

    return $this->sendSmsDataToUser($otp, $mobileno);
  }

  public function forgotOtpVerifyModule() {
    if (count($this->input->post()) > 0) {
      $otp = $this->input->post('otp');
      $this->db->select('userid');
      $this->db->where('code', $otp);
      $this->db->where('status', 0);
      $query = $this->db->get($this->_staff_sms_codes);
      if ($query->num_rows() > 0) {
        $userid = $query->row()->userid;

        $this->db->where('code', $otp);
        $this->db->update($this->_staff_sms_codes, array('status' => 1));

        return $userid;
      } else
        return 0;
    } else
      return 0;
  }

  public function updatePasswordModule() {
    if ((int) count($this->input->post()) == 2) {
      $userid = (int) $this->input->post('id');
      $data['password'] = sha1($this->input->post('pwd'));
      $this->db->where('id', $userid);
      $this->db->update($this->_staff_member, $data);
      return 1;
    } else
      return 0;
  }

  public function menuItemCompleteModule() {
    if (count($this->input->post()) > 0) {
      $data['complete'] = 1;
      $menu_id = (int) $this->input->post('menu_id');
      $order_id = (int) $this->input->post('order_id');

      $this->db->where(array('menu_id' => $menu_id, 'order_id' => $order_id));
      $this->db->update($this->_order_menu_id, $data);
      return 1;
    } else {
      return 0;
    }
  }

  public function changeProfilePicModule() {
    if (count($this->input->post()) > 0) {
      $id = $this->input->post('id');
      $image = $this->input->post('userfile');
      if ($image != '') {
        $name = md5(time() . uniqid()) . ".jpg";
        $data['pic'] = $name;
        $decodedImage = base64_decode($image);
        $file = $this->_folder_root . $name;
        $file = fopen($file, 'wb');
        fwrite($file, $decodedImage);
        fclose($file);

        $this->db->where('id', $id)->update($this->_staff_member, $data);
        return (int) $this->db->affected_rows();
      }
    }
    return 0;
  }

  //Edit By Web Shuttle - 27th Jan 2017 onwards//

  public function getMenuItems($estabid = '', $categoryid = 1) {
    if ($estabid != '') {
      $userid = $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->userid;
      $this->db->select($this->_category . '.id as cid, ' . $this->_category . '.category_name');
      $this->db->group_by($this->_menu_category . '.category_id');
      $this->db->where($this->_menu_category . '.user_id', $userid);
      //$this->db->where($this->_menu_category . '.main_category', $categoryid);
      $this->db->from($this->_menu_category);
      $this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
      $category_query = $this->db->get();
      $sl = 0;
      $result = array();
      if ($category_query->num_rows() > 0) {
        $sub_cat_result = $category_query->result();
        //$data['category'] = $sub_cat_result;
        foreach ($sub_cat_result as $cdata) {
          $subcatid = $cdata->cid;
          $this->db->select($this->_menu_items . '.id as menu_id, ' . $this->_menu_items . '.item_name, ' . $this->_menu_items . '.price, ' . $this->_menu_items . '.item_type');
          $this->db->distinct($this->_menu_category . '.category_id');
          $this->db->where($this->_menu_category . '.user_id', $userid);
          //$this->db->where($this->_menu_category . '.main_category', $categoryid);
          $this->db->where($this->_menu_category . '.category_id', $subcatid);
          $this->db->from($this->_menu_category);
          $this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
          $menu_items_qry = $this->db->get();
          $res = $menu_items_qry->result();

          if (is_array($res) && !empty($res)) {
            foreach ($res as $mdata) {
              $result[$sl] = $mdata;
              $sl++;
            }
          }
        }
      }
      return $result;
      //return $data;
    }
    return;
  }

  public function getOrderId() {
    $this->db->select('max(order_id) as orderId');
    $this->db->where('establishment_id > 0');
    $this->db->from($this->_order);
    $res = $this->db->get();
    $res = $res->row();
    return $res;
  }
  
  
  public function viewLocationModule($serverid) {
    $estabid = $serverid;

    $data = array();
    $data['cinema'] = '';
    $data['rest'] = '';

    $cinema_query = $this->db->get_where($this->_cinema_audi, array('cinema_id' => $estabid));
    if ($cinema_query->num_rows() > 0) {
      $data['cinema'] = $cinema_query->result();
    } else {
      $rest_query = $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid));
      if ($rest_query->num_rows() > 0) {
        $this->db->select($this->_restaurants_location . '.id, ' . $this->_restaurants_floor . '.id as floorId, ' . $this->_restaurants_location . '.location_name, ' . $this->_restaurants_location . '.form');
        $this->db->where($this->_restaurants_floor . '.estab_id', $estabid);
        $this->db->order_by($this->_restaurants_floor . '.floor_id');
        $this->db->from($this->_restaurants_floor);
        $this->db->join($this->_restaurants_location, "$this->_restaurants_location.restaurant_floor_id = $this->_restaurants_floor.id");
        $data['rest'] = $this->db->get()->result();
      }
    }
    return $data;
  }
  
  public function ThresoldLimit($eid) {
    $this->db->select('value');
    $this->db->where("eid = '".$eid."'");
    $this->db->from($this->_threshold);
    $res = $this->db->get();
    $res = $res->row();
    return $res;
  }
  
  public function updateOrder($orderid) {
    $this->db->where(array('order_id' => $orderid))->update($this->_order, array('status' => 5));
    $res = array("success"=>true,"message"=>"Order Status Updated.");
    return $res;
  }

}
