<?php 
class Users extends Controller {
    private $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    public function register() {
        // Check for Posts
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

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
            //Validate Password/
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
                } else {
                    $data['confirmPassword_err'] = '';
                }
            }

            //Make sure errors are empty
            if (empty($data['name_err']) && empty($data['email_err'])
            && empty($data['confirmPassword_err'])) {
                //Validated
                
                //Has password
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can LogIn');
                    redirect('users/login'); // faltaba una s
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
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

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
                // aqui deberia iniciar sesion o algo asi
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
                    $this->createUserSession($loggedInUser); // ahhh, es aqui
                    die('sesion iniciada');
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
        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }
        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }
    }
