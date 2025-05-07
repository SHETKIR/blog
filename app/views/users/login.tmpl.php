<?php
require_once('app/views/components/header.php');

$error = $_SESSION['error'] ?? '';
if ($error) {
    echo "<div class='alert alert-danger'>$error</div>";
    unset($_SESSION['error']);
}

$success = $_SESSION['success'] ?? '';
if ($success) {
    echo "<div class='alert alert-success'>$success</div>";
    unset($_SESSION['success']);
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Don't have an account? <a href="register">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('app/views/components/footer.php');
?> 