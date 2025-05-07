<?php require_once COMPONENTS.'/header.php'; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <?php require_once COMPONENTS.'/sidebar.php'; ?>
            
            <div class="col-10">
                <h2><?= $header ?></h2>
                
                <?php getAlerts(); ?>
                
                <form method="POST" action="/new-post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post title</label>
                        <input type="text" class="form-control <?= isset($validator) && $validator->hasErrors() && isset($validator->errors['title']) ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= old('title') ?>">
                        <?= isset($validator) ? $validator->listErrors('title') : '' ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Post description</label>
                        <input type="text" class="form-control <?= isset($validator) && $validator->hasErrors() && isset($validator->errors['excerpt']) ? 'is-invalid' : '' ?>" id="excerpt" name="excerpt" value="<?= old('excerpt') ?>">
                        <?= isset($validator) ? $validator->listErrors('excerpt') : '' ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Post content</label>
                        <textarea class="form-control <?= isset($validator) && $validator->hasErrors() && isset($validator->errors['content']) ? 'is-invalid' : '' ?>" id="content" name="content" rows="8"><?= old('content') ?></textarea>
                        <?= isset($validator) ? $validator->listErrors('content') : '' ?>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS.'/footer.php'; ?> 