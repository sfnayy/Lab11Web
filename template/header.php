<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Web Lab 12</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid p-0"> <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="<?= BASE_URL ?>/home/index">✨ Lab 12 Web</a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/home/index">Home</a></li>
                            <?php if (isset($_SESSION['is_login'])): ?>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/artikel/index">Artikel</a></li>
                            <?php endif; ?>
                        </ul>
                        
                        <ul class="navbar-nav ms-auto">
                            <?php if (isset($_SESSION['is_login'])): ?>
                                <li class="nav-item"><span class="nav-link fw-bold text-primary">Hi, <?= $_SESSION['nama'] ?></span></li>
                                <li class="nav-item"><a class="nav-link text-danger" href="<?= BASE_URL ?>/user/logout">Logout</a></li>
                            <?php else: ?>
                                <li class="nav-item"><a class="nav-link btn btn-primary text-white px-4 ms-2" href="<?= BASE_URL ?>/user/login">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <div class="container mt-5">
        <div class="main-content">
            <main>