<?php
require_once('app/views/components/header.php');

$error = $_SESSION['error'] ?? '';
if ($error) {
    echo "<div class='alert alert-danger'>$error</div>";
    unset($_SESSION['error']);
}

$errors = $_SESSION['errors'] ?? [];
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form method="POST" action="register">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= $_SESSION['old']['name'] ?? '' ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['name'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $_SESSION['old']['email'] ?? '' ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['email'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password" name="password" required>
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['password'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>" id="password_confirm" name="password_confirm" required>
                            <?php if (isset($errors['password_confirm'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['password_confirm'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="login">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Clear session data
unset($_SESSION['errors']);
unset($_SESSION['old']);

require_once('app/views/components/footer.php');
?> 