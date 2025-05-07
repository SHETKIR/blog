<?php require_once COMPONENTS.'/header.php'; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3><?= $header ?></h3>
                
                <div class="d-flex align-items-center mb-3">
                    <div class="rating-container me-3">
                        <button id="up_btn" name="up_btn" data-post-id="<?= isset($post['id']) ? $post['id'] : $post['post_id'] ?>" data-action="1" class="btn btn-success">UP</button>
                        
                        <span id="rate_p" class="mx-2 fw-bold">
                            Rate: <?= isset($post['rate']) ? (int)$post['rate'] : 0 ?>
                        </span>
                        
                        <button id="down_btn" name="down_btn" data-post-id="<?= isset($post['id']) ? $post['id'] : $post['post_id'] ?>" data-action="-1" class="btn btn-warning">DOWN</button>
                    </div>
                </div>
                
                <p><?= $post['content'] ?></p>
                
                <div class="mt-4">
                    <form action="/delete-post" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        <input type="hidden" name="id" value="<?= isset($post['id']) ? $post['id'] : $post['post_id'] ?>">
                        <button type="submit" class="btn btn-danger">Delete Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS.'/footer.php'; ?> 