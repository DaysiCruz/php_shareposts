<?php 
class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
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
            } else {
                //Check Email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is ready taken';
                }
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
                
                //Has password 
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_succes', 'You are registered and can LogIn');
                    redirect('user/login');
                } else {
                    die('Something went wrong');
                }
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
            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User no found
                $data['email_err'] = 'No user found';
            }

            //Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                //Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                if ($loggedInUser) {
                    // Create Session
                    die('SUCCESS');
                } else {
                    $data['password_err'] = 'Password Incorrect';
                    $this->view('users/login',$data);
                }
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