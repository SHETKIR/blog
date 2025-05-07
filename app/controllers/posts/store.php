<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validator = new Validator();
    $validationResult = $validator->validate(
        data: [
            'title' => 'AAAAAAAAAAAAA',
            'excerpt' => 'AAAAAAAAAAAAA',
            'content' => 'AAAAAAAAAAAAA'
        ],
        rules: $rules);
    
    if(!$validationResult->hasErrors()) {
        $sql = "SELECT `post_id` FROM `posts` ORDER BY `post_id` DESC LIMIT 1";
        $id = $db->query(query: $sql)->find()['post_id'];
        $slug = "post-".++$id;
        $sql = "INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES (?, ?, ?, ?)";
        if($db->query(query: $sql, params: ['title'=>$data['title'], 'excerpt'=>$data['excerpt'], 'content'=>$data['content']])) {
            $_SESSION['success'] = "Post created successfully";
        }
        else {
            $_SESSION['error'] = "Data Base Error";
        }
    }
    
    redirect(url: '/');
} 