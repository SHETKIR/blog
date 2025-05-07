<?php
require_once CORE . '/classes/Validator.php';

global $db;

$header = "New Post";
    
    $rules = [
        'title' => [
            'required' => true,
        ],
        'excerpt' => [
            'required' => true,
        ],
        'content' => [
            'required' => true,
    ]
    ];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'excerpt', 'content'];
    $data = loadPOSTData(fillable: $fillable);
    
    $validator = new Validator();
    
    if(!$validator->validate(data: $data, rules: $rules)->hasErrors()) {
        // Generate a unique slug - handle case when posts table might be empty
        $slug = 'post-'.time(); // Default fallback using timestamp
        
        // Try to get the latest post_id if posts table exists and has records
        $sql = "SELECT `post_id` FROM `posts` ORDER BY `post_id` DESC LIMIT 1";
        $result = $db->query(query: $sql);
        if($result !== false) {
            $row = $result->find();
            if($row) {
                $slug = 'post-'.($row['post_id'] + 1);
            }
        }
        
        $sql = 'INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES (:title, :slug, :excerpt, :content)';
        if($db->query(query: $sql, params: ['title'=>$data['title'], 'slug'=> $slug,'excerpt'=>$data['excerpt'],'content'=>$data['content']])) {
            $_SESSION['success'] = "Post created successfully";
            redirect(url: '/');
        }
        else {
            $_SESSION['error'] = "Data Base Error";
        }
    }
}

require_once VIEWS.'/new-post.tmpl.php'; 