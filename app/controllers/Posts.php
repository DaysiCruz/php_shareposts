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
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'edit' => $id,                'tittle' => trim($_POST['tittle']),
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
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Post Updated');
                    redirect('post');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/edit', $data);
            }
        } else {
            // Get from existing post from model
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('post');
            }
            $data = [
                'id' => $id,
                'tittle' => $post->tittle,
                'body' => $post->body,
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
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
             // Get from existing post from model
            $post = $this->postModel->getPostById($id);

             // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('post');
            }
            if($this->postModel->delete($id)) {
                flash('post_message', 'Post Removed');
                redirect('post');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }
}