<?php 
class Posts extends Controller {
    public function __construct(){
            if (!isLoggenInd()) {
                redirect('/user/login');
            }
            $this->postModel = $this->model('Post');
        }

        public function index() {
            // Get posts
            $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts,
        ];

        $this->view('posts/index',$data);
    }
}