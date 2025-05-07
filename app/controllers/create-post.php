<?php
$title = "Create Post";
$fillable = ['title', 'content', 'excerpt'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = loadPOSTData(fillable: $fillable);
    // dd($data);
    
    if(empty($data['title'])) {
        $errors['title'] = "Post title is required";
    }
    
    if(empty($data['content'])) {
        $errors['content'] = "Post content is required";
    }
    
    if(empty($data['excerpt'])) {
        $errors['excerpt'] = "Post excerpt is required";
    }
    
    if(empty($errors)) {
        $sql = "SELECT `post_id` FROM `posts` ORDER BY `post_id` DESC LIMIT 1";
        $id = $db->query(query: $sql)->find()['post_id'];
        $slug= 'post-'.++$id;
        // $sql = 'INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES (?, ?, ?, ?)';
        // $db->query($sql, [$_POST['title'], $slug, $_POST['excerpt'], $_POST['content']]);
        
        $sql = 'INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES (:title, :slug, :excerpt, :content)';
        if($db->query(query: $sql, params: ['title'=>$data['title'], 'slug'=> $slug,'excerpt'=>$data['excerpt'],'content'=>$data['content']])) {
            echo "Post created successfully";
        }
        else {
            echo "Data Base Error";
        }
    }
}

require_once VIEWS.'/create-post.tmpl.php'; 