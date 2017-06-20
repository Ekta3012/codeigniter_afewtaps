<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estab extends CI_Controller {

    private $_establishment;
    private $_coupon;
    private $_offer;
    private $_category;
    private $_estab_rating;
    private $_estab_outlet_timing;

    public function __construct() {
        parent::__construct();

        $this->_establishment = $this->db->dbprefix('establishment');
        $this->_coupon = $this->db->dbprefix('coupon');
        $this->_offer = $this->db->dbprefix('offer');
        $this->_category = $this->db->dbprefix('category');
        $this->_estab_rating = $this->db->dbprefix('estab_rating');
        $this->_estab_outlet_timing = $this->db->dbprefix('estab_outlet_timing');
    }

    public function offer() {
        header('Content-Type: application/json');
        $result = $this->menumodel->offerModule();
        echo json_encode(array('response' => $result));
    }

    public function index() {
        $result = array();
        if (count($this->input->post()) > 0) {
            $lat = $this->input->post('latSt');
            $lng = $this->input->post('lngSt');
//            echo $lat;
//            echo '<br>';
//            echo $lng;die();
            $userid = (int) $this->input->post('userid');
            $query = $this->db->query("SELECT `id`, `logo`, `cover_image`, `name`, `address`, `lat`, `lng`, SQRT(POW(69.1 * (lat - $lat), 2) + POW(69.1 * ($lng - lng) * COS(lat / 57.3), 2)) AS distance FROM `$this->_establishment` HAVING distance < 100 ORDER BY distance");

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $res)
                    $res_id[] = $res->id;
            }

            $today = strtolower(date('D'));
            $timing_today = "";

            $eid = "";
            $this->db->where_in('estabid', $res_id);
            $this->db->where("$today !=", '');
            $query_res = $this->db->get($this->_estab_outlet_timing);
            if ($query_res->num_rows() > 0) {
                foreach ($query_res->result() as $qdata)
                    $eid[] = $qdata->estabid;
            }

            $this->db->where_in('id', $eid);
            $sql_query = $this->db->get($this->_establishment);
            if ($sql_query->num_rows() > 0) {
                foreach ($sql_query->result() as $result_data) {
                    $timing = $this->db->select($today)->get_where($this->_estab_outlet_timing, array('estabid' => $result_data->id));
                    if ($timing->num_rows() > 0) {
                        $today_timing = $timing->row()->$today;
                        if (!empty($today_timing)) {
                            /* $timing_today_json =  json_decode($today_timing);
                              $timing_exp        =  explode (':', $timing_today_json->otime);
                              $timing_open_hr    = (int) $timing_exp[0];
                              $timing_open_min   = (int) $timing_exp[1];

                              if ($timing_open_hr == 12 && $timing_open_min == 0)
                              $omeridian = "Noon";
                              elseif ($timing_open_hr < 12)
                              $omeridian = "AM";
                              elseif
                              $omeridian = "PM";


                              $open_hr             =   str_pad($timing_open_hr, 0, 2, str_pad_left);
                              $open_min            =   str_pad($timing_open_min, 0, 2, str_pad_left);

                              $open_format         =   $open_hr . ':' . $open_min . $omeridian;


                              $timing_exp          =   explode (':', $timing_today_json->ctime);
                              $timing_close_hr     =  (int) $timing_exp[0];
                              $timing_close_min    =  (int) $timing_exp[1];

                              $close_hr            =   str_pad($timing_close_hr, 0, 2, str_pad_left);
                              $close_min           =   str_pad($timing_close_min, 0, 2, str_pad_left);


                              if ($close_hr == 24 && $close_min == 0)
                              $cmeridian = "Midnight";
                              elseif ($close_hr > 12)
                              $cmeridian = "PM";
                              elseif
                              $cmeridian = "AM";


                              $close_format        =   ($close_hr - 12) . ':' . $close_min . $cmeridian;



                              $timing_today        =   $open_format. ' to ' .$close_format; */

                            $timing_today_json = json_decode($today_timing);

                            $timing_exp = explode(':', $timing_today_json->otime);
                            $timing_open_hr = (int) $timing_exp[0];
                            $timing_open_min = (int) $timing_exp[1];


                            $omeridian = '';

                            if ($timing_open_hr == 12 && $timing_open_min == 0)
                                $omeridian = " Noon";
                            elseif ($timing_open_hr < 12)
                                $omeridian = " AM";
                            else
                                $omeridian = " PM";


                            if ($timing_open_hr > 12)
                                $timing_open_hr = $timing_open_hr - 12;


                            $open_hr = str_pad($timing_open_hr, 2, '0', STR_PAD_LEFT);
                            $open_min = str_pad($timing_open_min, 2, '0', STR_PAD_LEFT);

                            $open_format = $open_hr . ':' . $open_min . $omeridian;


                            $timing_exp = explode(':', $timing_today_json->ctime);
                            $timing_close_hr = (int) $timing_exp[0];
                            $timing_close_min = (int) $timing_exp[1];


                            if (($timing_close_hr == 12) && ($timing_close_min == 0))
                                $cmeridian = " Noon";
                            elseif (($timing_close_hr == 24) && ($timing_close_min == 0))
                                $cmeridian = " Midnight";
                            elseif (($timing_close_hr == 24) && ($timing_close_min > 0))
                                $cmeridian = " AM";
                            elseif (($timing_close_hr > 12) || ($timing_close_hr == 12 && $timing_close_min > 0))
                                $cmeridian = " PM";
                            else
                                $cmeridian = " AM";

                            if ($timing_close_hr > 12)
                                $close_hr = str_pad(($timing_close_hr - 12), 2, '0', STR_PAD_LEFT);
                            else
                                $close_hr = str_pad($timing_close_hr, 2, '0', STR_PAD_LEFT);


                            $close_min = str_pad($timing_close_min, 2, '0', STR_PAD_LEFT);


                            $close_format = $close_hr . ':' . $close_min . $cmeridian;

                            $timing_today = $open_format . ' to ' . $close_format;
                        }
                    }


                    $code = '';
                    $min_amt = '';
                    $time = time();
                    $code_qry = $this->db->get_where($this->_coupon, array('estabid' => $result_data->id, 'status' => 1, 'valid_till >=' => $time));

                    //$code     = ($code_qry->num_rows() > 0) ? $code_qry->row()->off : '';

                    if ($code_qry->num_rows() > 0) {
                        $code_res = $code_qry->row();
                        $code = $code_res->off;
                        $min_amt = $code_res->min_amt;
                    }

                    if (empty($code)) {
                        $code_qry = $this->db->get_where($this->_offer, array('estabid' => $result_data->id, 'ostatus' => 1, 'valid_till >=' => $time));
                        if ($code_qry->num_rows() > 0) {
                            $result_obj = $code_qry->row();

                            $category_name = $this->db->select('category_name')->get_where($this->_category, array('id' => $result_obj->category_id))->row()->category_name;
                            $code = "1+1 on $category_name";
                        }
                    }

                    if($this->input->post('userid')!=""){
                        $this->db->where(array('estabid' => $result_data->id, 'is_read' => 0, 'userid' => $userid, 'reply !=' => ''));
                    }else{
                        $this->db->where(array('estabid' => $result_data->id, 'is_read' => 0,'reply !=' => ''));
                    }
                    $this->db->order_by('id', 'desc');
                    $this->db->limit(1);
                    $rating_notify_count = (int) $this->db->get($this->_estab_rating)->num_rows();
//                    echo $this->db->last_query();
                    $result[] = array('id' => $result_data->id, 'name' => $result_data->name, 'logo' => (string) $result_data->logo, 'cover_image' => (string) $result_data->cover_image, 'address' => $result_data->address, 'off' => $code, 'notify_count' => "$rating_notify_count", 'timing' => $timing_today, 'min_amt' => $min_amt);
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode(array('response' => $result));
    }

    public function searchEstablishment() {
        header('Content-Type: application/json');
        $result = $this->menumodel->searchEstab();
        echo json_encode(array('response' => $result));
    }

    public function badgeCount() {
        header('Content-Type: application/json');
        $result = $this->menumodel->badgeCountModule();
        echo json_encode(array('response' => $result));
    }

    public function badgeRead() {
        header('Content-Type: application/json');
        $result = $this->menumodel->badgeReadModule();
        echo json_encode(array('response' => $result));
    }

    public function badge() {
        header('Content-Type: application/json');
        $result = $this->menumodel->badgeModule();
        echo json_encode(array('response' => $result));
    }

    public function feedback() {
        header('Content-Type: application/json');
        $result = $this->menumodel->feedbackModule();
        echo json_encode(array('response' => $result));
    }

    public function orderStatus() {
        header('Content-Type: application/json');
        $result = $this->menumodel->orderStatusModule();
        echo json_encode(array('status' => $result));
    }

}
