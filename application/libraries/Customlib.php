<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customlib {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('user_agent');
    }

    public function setUserLog($login_id, $username, $role) {
        if ($this->CI->agent->is_browser()) {
            $agent = $this->CI->agent->browser() . ' ' . $this->CI->agent->version();
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->CI->agent->robot();
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $data = array(
            'login_id' => $login_id,
            'username' => $username,
            'role' => $role,
            'ipaddress' => $this->CI->input->ip_address(),
            'user_agent' => $agent . ", " . $this->CI->agent->platform(),
        );

        $this->CI->Userlog->add($data);
    }

    function getGender() {
        $gender = array();
        $gender['Male'] = $this->CI->lang->line('male');
        $gender['Female'] = $this->CI->lang->line('female');
        return $gender;
    }

    function getProjectType() {
        $project = array();
        $project['WORK']['lable'] = "Work";
        $project['WORK']['description'] = "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...";
        $project['DBT']['lable'] = "Direct Benifit Transfer";
        $project['DBT']['description'] = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
        return $project;
    }

    function reporting_type() {
        $reporting = array();

        $reporting['YN']['lable'] = "Yes or No";
        $reporting['YN']['description'] = "Reporting by the child by project wise Yes or No";

        $reporting['AMT']['lable'] = "Amount";
        $reporting['AMT']['description'] = "Reporting by the child by project wise Amount Spent";

        $reporting['PIC_AMT']['lable'] = "Picture + Amount";
        $reporting['PIC_AMT']['description'] = "Reporting by the child by project wise Amount Spent & Site Photograph";

        $reporting['NA']['lable'] = "Not Defined";
        $reporting['NA']['description'] = "Reporting not defined yet";

        return $reporting;
    }

    function getMonthDropdown() {
        $array = array();
        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $array[$month] = $month;
        }
        return $array;
    }

    function getMonthList() {
        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'Decmber');
        return $months;
    }

    public function userdetail() {
        return $this->CI->session->userdata('login_detail');
    }
    
    public function getLable(){
        $response = [];
        $lable_arr = $this->CI->Login_user->labeling();
        foreach ($lable_arr as $data){
            $key = $data['default_lable'];
            $response[$key] = $data['new_lable'];
        }
        return $response;
    }

    public function inr_format($figure) {
        if ($figure > 99000 && $figure <= 9900000) {
            $figure = (float)($figure / 100000);
            return number_format(round($figure, 2), 2) . " Lakh";
        } elseif ($figure > 9900000) {
            $figure = (float)($figure / 10000000);
            return number_format(round($figure, 2), 2) . " Cr";
        } else {
            return number_format(round($figure, 2), 2);
        }
    }

}
