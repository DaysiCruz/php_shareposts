<?php
class Pages extends Controller {
    public function __construct() {
        
    }
    public function index() {
        
        $data = ['title' => 'Welcome', 
        'description' => 'Simple social network built on the TraversyMVC PHP Framework'];
        $this->view('pages/index', $data);

        
    }
    public function about() {
        $data = ['title' => 'About',
        'description' => 'lala'];
        $this->view('pages/about',$data);
    }
}