<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "BLOG" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/main.css">
    <script src="/scripts/main.js"></script>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: black !important">
                <div class="container-fluid container">
                    <a class="navbar-brand" href="/">BlogP21</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contacts">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/new-post">New Post</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
