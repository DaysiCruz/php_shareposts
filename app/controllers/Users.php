<?php 
class User extends Controller {
    public function __construct() {

    }
    public function register() {
        // Check for Posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form

            //Sanitize POST data
            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                //save errors
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirmPassword_err' => '',
            ];
            //Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please add your email';
            }
            //Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please add your name';
            }
            //Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please add your email';
            } elseif(strlen($data['password'] < 6)) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            //Validate Confirm Password
            if (empty($data['confirmPassword'])) {
                $data['confirmPassword_err'] = 'Please confirm your pass';
            } else {
                if ($data['password'] != $data['confirmPassword'])  {
                    $data['confirmPassword_err'] = 'Password o not match';
                }
            }

            //Make sure errors are empty
            if (empty($data['email_err']) && empty($data['email_err'])
            && empty($data['confirmPassword_err'])) {
                //Validated 
                die('SUCCESS');
            } else {
                //Load view with error
                $this->view('users/register',$data);
            }

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

            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                //save errors
                'email_err' => '',
                'password_err' => '',
            ];
            //Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please add your email';
            }
            //Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please add your password';
            }
            //Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                //Validated
                die('SUCCESS');
            } else {
                //Load view with error
                $this->view('users/register',$data);
            }
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