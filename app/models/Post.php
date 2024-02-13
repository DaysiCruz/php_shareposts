<?php 
class Post {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    public function getPosts() {
        $this->db->query("SELECT *,
                                posts.id as postId,
                                users.id as userId
                                posts.created_at as postCreated,
                                users.created_at as userCreated,
                                FROM posts
                                INNER JOIN users 
                                ON posts.user_id = users_id
                                ORDER BY posts.created_at DESC
                                ");

        $results = $this->db->resultSet();

        return $results;
    }
    public function addPost($data) {
        //Register User
        $this->db->query('INSERT INTO posts(tittle,user_id,body) VALUES(:name,:email,:password)');
        //Bind Values
        $this->db->bind(':tittle', $data['name']);
        $this->db->bind(':user_id', $data['email']);
        $this->db->bind(':body', $data['password']);

        // Excute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePost($data) {
        //Register User
        $this->db->query('UPDATE posts SET tittle = :tittle, body = :body WHERE id = :id');
        //Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':tittle', $data['name']);
        $this->db->bind(':body', $data['body']);

        // Excute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getPostById($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

}