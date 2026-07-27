<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Laravel&Me</title>
</head>
<header>
    <h1 class="text-center text-light bg-secondary" style="margin-bottom: 0px;">Laravel&Me</h1>
    <nav class="navbar navbar-expand-lg bg-secondary bg-gradient fw-medium" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://laravel.com/docs/11.x">Laravel 11</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://getbootstrap.com/">Bootstrap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/halaman1">Halaman 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/halaman2">Halaman 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/halaman3">Halaman 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/halaman4">Halaman 4</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body class="bg-dark text-white">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <h1 class="text-center container mt-2">Welcome, Ravellers!</h1>
    <p class="text-center container">Saya pusing hari ini. <br> Silahkan baca catatan saya tentang pembelajaran Laravel 11</p>
    <div class="container">
    <div class="accordion" data-bs-theme="dark" id="accordionExample">
  <div class="accordion-item" class="accordion-collapse">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Bagaimana cara membuat proyek Laravel 11?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Gunakan command di bawah ini:</strong> <br>
        <code>composer create-project --prefer-dist laravel/laravel nama_proyek</code>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Bagaimana cara menjalankan proyek di browser?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Jalankan command ini di Git Bash: <br> <code>php artisan serve</code> <br> <strong>Pastikan Git Bash dijalankan di direktori proyek Laravel kamu.</strong>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Dimana folder proyek Laravel dalam pembelajaran?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Folder proyek Laravel dalam pembelajaran ini adalah <br><code>C:/laragon/www/laravel11-scientia</code> <br>
      </div>
    </div>
  </div>
</div>
</div>
</body>
<footer class="bg-dark bg-gradient text-light text-center py-3 fixed-bottom">
    <p>&copy; 2025 Scientia Hashina <br> Made with Laravel and Bootstrap.</p><br>
</footer>
</html>
