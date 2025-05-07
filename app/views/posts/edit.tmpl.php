<?php
require_once COMPONENTS.'/header.php';

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';

$post_title = $old['title'] ?? $post['title'] ?? '';
$post_content = $old['content'] ?? $post['content'] ?? '';
$post_excerpt = $old['excerpt'] ?? $post['excerpt'] ?? '';



if ($success) {
    echo "<div class='alert alert-success'>$success</div>";
    unset($_SESSION['success']);
}
?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3><?= $header ?></h3>
                
                <form action="/posts/update" method="POST">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= htmlspecialchars($post_title) ?>" required>
                        <?php if (isset($errors['title'])): ?>
                            <div class="invalid-feedback d-block">
                                <?= $errors['title'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control <?= isset($errors['excerpt']) ? 'is-invalid' : '' ?>" id="excerpt" name="excerpt" rows="3" required><?= htmlspecialchars($post_excerpt) ?></textarea>
                        <?php if (isset($errors['excerpt'])): ?>
                            <div class="invalid-feedback d-block">
                                <?= $errors['excerpt'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>" id="content" name="content" rows="10" required><?= htmlspecialchars($post_content) ?></textarea>
                        <?php if (isset($errors['content'])): ?>
                            <div class="invalid-feedback d-block">
                                <?= $errors['content'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                        <a href="/post?id=<?= $post['id'] ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
unset($_SESSION['errors']);
unset($_SESSION['old']);

require_once COMPONENTS.'/footer.php';
?> 