<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Meme Library</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

  <nav id="vrh" class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="https://www.solve-x.net/wp-content/uploads/2020/12/Solve-X.png" width="100" height="40" class="d-inline-block align-top" alt="Solve-X logo">
        <span id="logoText">Solve-X meme library</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Domov</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">O nas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kontakt</a>
          </li>
          <?php
          session_start();
          $preveri = isset($_SESSION['loggedin']);
          if ($preveri == true) {
            if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) {
              echo '<li class="nav-item"><a class="nav-link" href="obrazecMeme.php">Dodaj meme</a></li>';
              echo '<li class="nav-item"><a class="nav-item nav-link disabled" style="color: black;"> Pozdravljeni ' . htmlspecialchars($_SESSION["username"]);
              '</a></li>';
              echo '<li class="nav-item"><a class="nav-link" href="odjava.php">Odjava</a></li>';
            }
          } else {
            echo '<li class="nav-item"><a class="nav-link" href="registracija.php">Registracija</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="prijava.php">Prijava</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>