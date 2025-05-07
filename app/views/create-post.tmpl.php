<?php require_once COMPONENTS.'/header.php'; ?>

<?php if (isset($redirect) && $redirect): ?>
<script>
    window.location.href = '/';
</script>
<?php endif; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <?php require_once COMPONENTS.'/sidebar.php'; ?>
            
            <div class="col-10">
                <h2>Create Post</h2>
                
                <form method="POST" action="/create-post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= old(fieldname: 'title') ?>">
                        <?php if (isset($errors['title'])): ?>
                            <div class="invalid-feedback d-block">
                            <?= $errors['title'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Post description</label>
                        <input type="text" class="form-control" id="excerpt" name="excerpt" value="<?= old(fieldname: 'excerpt') ?>">
                        <?php if (isset($errors['excerpt'])): ?>
                            <div class="invalid-feedback d-block">
                            <?= $errors['excerpt'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Post content</label>
                        <textarea class="form-control" id="content" name="content" rows="8"><?= old(fieldname: 'content') ?></textarea>
                        <?php if (isset($errors['content'])): ?>
                            <div class="invalid-feedback d-block">
                            <?= $errors['content'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS.'/footer.php'; ?> 