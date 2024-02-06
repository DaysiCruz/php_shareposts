<?php 
class User extends Controller {
    public function __construct() {

    }
    public function register() {
        // Check for Posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form
        } else {
            // init data
            $data =[
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                //save errors
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirmPassword_err' => '',
            ];
            //load view
            $this->view('users/register', $data);
        }
    }
    public function login() {
        // Check for Posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form
        } else {
            // init data
            $data =[
                'email' => '',
                'password' => '',
                //save errors
                'email_err' => '',
                'password_err' => '',
                
            ];
            //load view
            $this->view('users/login', $data);
        }
    }
}