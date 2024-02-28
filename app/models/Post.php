<?php 
class Post {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPosts() {
        $this->db->query("SELECT *,
                                posts.id as postId,
                                users.id as userId,
                                posts.created_at as postCreated,
                                users.created_at as userCreated
                                FROM posts 
                                INNER JOIN users 
                                ON posts.user_id = :user_id
                                ORDER BY posts.created_at DESC
                                ");
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $results = $this->db->resultSet();
        
        return $results;
    }
    public function addPost($data) {
        //Register User
        $this->db->query('INSERT INTO posts(title,user_id,body) VALUES(:title, :user_id, :body)');
        //Bind Values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        // Excute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePost($data) {
        //Register User
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        //Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // Debugging: Log the SQL query and data bindings
        error_log('SQL Query: ' . $this->db->getQuery());
        error_log('Data Bindings: ' . print_r($this->db->getBindings(), true));

        // Excute
        if ($this->db->execute()) {
            error_log('Post updated successfully');
            return true;
        } else {
            error_log('Error updating post: ' . $this->db->errorMessage());
            return false;
        }
    }
    public function getPostById($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }
    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        //Bind Values
        $this->db->bind(':id', $id);

        // Excute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}