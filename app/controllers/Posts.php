<?php 
class Posts extends Controller {
    public function __construct(){
            if (!isLoggenInd()) {
                redirect('/user/login');
            }
        }

        public function index() {
        $data = [];

        $this->view('posts/index',$data);
    }
}