<?php 
class Posts extends Controller {
    public function __construct(){
            if (!isLoggenInd()) {
                redirect('/user/login');
            }
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        public function index() {
            // Get posts
            $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts,
        ];

        $this->view('posts/index',$data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'tittle' => trim($_POST['tittle']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'tittle_err' => '',
                'body_err' => ''
            ];
            
            // Validate tittle
            if(empty($data['tittle'])) {
                $data['tittle_err'] = 'Please enter tittle';
            }
            // Validate Body
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter Body';
            }
            // Make sure no errors
            if (empty($data['tittle_err']) && empty($data['body_err'])) {
                // Validated
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    redirect('post');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/add', $data);
            }
          
            
        } else {
            $data = [
                'tittle' => '',
                'body' => '',
            ];
    
            $this->view('posts/add',$data);
        }
    }
    public function show($id) {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'posts' => $post,
            'user' => $user
        ];
        $this->view('posts/show',$data);

    }
   
}