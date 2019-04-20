<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function index() {

        $response = $this->Login_user->organisation_info();
        //print_r($response);
        //die;
        if ($response == 0) { //if organisation is not registered
            redirect(base_url('welcome/setup'));
        } else { //if organisation is registered
            $data['organisation_info'] = $response;
            // If captcha form is submitted
            if (isset($_POST['submit'])) {
                $sessCaptcha = $this->session->userdata('captchaCode');
                $inputCaptcha = $this->input->post('captcha');
                if ($inputCaptcha === $sessCaptcha) {
                    $this->form_validation->set_rules('username', 'Username', 'required');
                    $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

                    if ($this->form_validation->run() == FALSE) {
                        // Captcha configuration
                        $config = $this->config->item('captcha');
                        $captcha = create_captcha($config);
                        // Unset previous captcha and set new captcha word
                        $this->session->unset_userdata('captchaCode');
                        $this->session->set_userdata('captchaCode', $captcha['word']);

                        // Pass captcha image to view
                        $data['captchaImg'] = $captcha['image'];
                        //redirect(base_url());
                        $this->load->view('welcome', $data);
                    } else {
                        $username = $this->input->post('username');
                        $password = $this->input->post('password');

                        $this->load->model('Login_user');
                        $response = $this->Login_user->check_login($username, $password);

                        switch ($response['login_type']) {
                            case 'ADMIN':
                                $session['login_detail'] = $response;
                                
                                $this->customlib->setUserLog($response['id'], $response['username'], $response['login_type']);
                                $this->session->set_userdata($session);
                                redirect(base_url('Admin/Dashboard'));
                                break;
                            case 'SCHOOL':
                                break;
                            case 'OTHER':
                                break;
                            default :
                                $this->session->set_flashdata("msg", "<p class='text-danger'>Either Username or Password Mismatched !</p>");
                                redirect(base_url());
                        }
                    }
                } else {
                    // Captcha configuration
                    $config = $this->config->item('captcha');
                    $captcha = create_captcha($config);
                    // Unset previous captcha and set new captcha word
                    $this->session->unset_userdata('captchaCode');
                    $this->session->set_userdata('captchaCode', $captcha['word']);

                    // Pass captcha image to view
                    $data['captchaImg'] = $captcha['image'];
                    $data['captcha_error'] = true;
                    $this->load->view('welcome', $data);
                }
            } else {
                // Captcha configuration
                $config = $this->config->item('captcha');
                $captcha = create_captcha($config);
                // Unset previous captcha and set new captcha word
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode', $captcha['word']);

                // Pass captcha image to view
                $data['captchaImg'] = $captcha['image'];
                $data['captcha_error'] = false;
                $this->load->view('welcome', $data);
            }
        }
    }

    public function setup() {
        $this->form_validation->set_rules('organisation_name', 'Organisation Name', 'trim|required');
        $this->form_validation->set_rules('head_name', 'Head Name', 'trim|required');
        $this->form_validation->set_rules('head_email', 'Head Email', 'trim|required|valid_email|is_unique[login_user.head_email]');
        $this->form_validation->set_rules('head_mobile', 'Head Mobile', 'trim|required|is_natural|min_length[10]|max_length[10]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('setup_view');
        } else {
            $password = strtolower(random_string('alpha', '6'));
            $username = $this->input->post('head_email');
            $head_email = $this->input->post('head_email');
            $ciphertext = base64_encode($username);

            $data = array(
                'organisation_name' => $this->input->post('organisation_name'),
                'head_name' => $this->input->post('head_name'),
                'head_email' => $head_email,
                'head_mobile' => $this->input->post('head_mobile'),
                'username' => $username,
                'password' => md5($password),
                'login_type' => 'ADMIN',
                'create_on' => date('Y-m-d H:i:s')
            );
            /* echo "<pre>";
              print_r($data);
              echo "</pre>"; */

            $this->Login_user->organisation_registration($data);

            //send email start
            $subject = 'CNVG Fund Management - Email Verification';
            $message = '<h3>Welcome to CNVG Fund Management System</h3>';
            $message .= "<h4>Click on the link below to verify your Email Id</h3>";
            $message .= "<p>Verification Link : <a href='" . base_url('welcome/verify_email') . "/" . $ciphertext . "'>Click Here</a></p>";

// Get full html:
            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
' . $message . '
</body>
</html>';
// Also, for getting full html you may use the following internal method:
//$body = $this->email->full_html($subject, $message);

            $result = $this->email
                    ->from('admin@cnvg.in', 'CNVG Fund Management')
                    ->to($head_email)
                    ->subject($subject)
                    ->message($body)
                    ->send();

            //var_dump($result);
            //echo '<br />';
            //echo $this->email->print_debugger();
            //send mail ends
            $this->session->set_flashdata('msg', 'Verification link has been sent to your registered email id : ' . $head_email);
            redirect(base_url('welcome/setup'));
            //$this->load->view('setup_view');
        }
    }

    public function verify_email($email) {
        $email = base64_decode($email);
        $response = $this->Login_user->detailBy_EmailId($email);
//        print_r($response);
//        die;
        if ($response == 0 || $response['email_verify'] == 1) {
            $data['message'] = "<div class='lastend-container'> <h1>404!</h1> <h2>You seem to be lost.</h2> <div class='error_msg'> The page you wanted to visit doesn't exist or may have been deleted </div> </div>";

            $this->load->view('print_message', $data);
        } else {
            $id = $response['id'];
            $password = strtolower(random_string('alpha', '6'));
            $this->Login_user->verify_organisation($id, md5($password));
            $response = $this->Login_user->detailBy_EmailId($email);
            //send email start
            $head_email = $response['head_email'];
            $username = $response['username'];

            $subject = 'CNVG Fund Management - Registration Success';
            $message = '<h3>Welcome to CNVG Fund Management System</h3>';
            $message .= "<h4>Login Credential</h3>";
            $message .= "<p>Link : " . base_url() . "</p>";
            $message .= "<p>Username : $username</p>";
            $message .= "<p>Password : $password</p>";

// Get full html:
            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
' . $message . '
</body>
</html>';
            $result = $this->email
                    ->from('admin@cnvg.in', 'CNVG Fund Management')
                    ->to($head_email)
                    ->subject($subject)
                    ->message($body)
                    ->send();

            $data['message'] = "<div class='lastend-container'> <h2>Email Verification</h2> <div class='error_msg'> Your email id has been successfully verified </div> </div>";

            $this->load->view('print_message', $data);
        }
    }

    public function refresh() {
        // Captcha configuration
        $config = $this->config->item('captcha');
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }

}
