<?php
class Pages extends Controller {
    public function __construct() {
        
    }
    public function index() {
        if(isLoggendIn()) {
            redirect('posts');
        }
        $data = ['title' => 'Welcome', 
        'description' => 'Simple social network built on the TraversyMVC PHP Framework'];
        $this->view('pages/index', $data);

        
    }
    public function about() {
        $data = ['title' => 'Shareposts',
        'description' => 'SharePosts es una emocionante aplicación desarrollada con el objetivo de proporcionar una plataforma interactiva para compartir ideas, experiencias y conocimientos. Diseñada con el poderoso paradigma de programación orientada a objetos y el patrón arquitectónico Modelo-Vista-Controlador (MVC), SharePosts representa el fruto del aprendizaje adquirido a través del curso de Object Oriented PHP & MVC de Udemy, impartido por el renombrado instructor Brad Traversy.
        Con SharePosts, esperamos brindar una experiencia única y gratificante para nuestros usuarios mientras fomentamos la colaboración y el intercambio de información en línea.'];
        $this->view('pages/about',$data);
    }
}