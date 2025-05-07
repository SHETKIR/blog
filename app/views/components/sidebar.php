<?php

$most_popular_posts = $db->query(query: "SELECT * FROM posts ORDER BY id DESC LIMIT 5")->findAll();
?>

<div class="col-2">
    <h3>Topics</h3>
    <ul class="list-group">
        <?php foreach ($most_popular_posts as $link): ?>
        <li class="list-group-item"><a class="nav-link" href="post?id=<?= $link['id'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach ?>
    </ul>
</div> 