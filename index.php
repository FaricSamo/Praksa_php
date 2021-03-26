<?php
include "header.php";

require __DIR__ . '/twig/vendor/autoload.php';


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Meme Library</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body class="d-flex flex-column min-vh-100">

   <div class="container">
      <?php

      echo '<div class="container my-2 t1">
               <div class="row">';

      $db = mysqli_connect("localhost", "root", "", "memelibrary");
      if (!$db) {
         die('Could not connect: ' . mysqli_connect_error());
      }

      $rezultat = mysqli_query($db, "SELECT * FROM memes;");
      while ($vrstica = mysqli_fetch_assoc($rezultat)) {

         echo $twig->render('memeTemplate.html.twig', [
            'id' => $vrstica['id'], 'title' => $vrstica['title'],
            'description' => $vrstica['description'], 'url' => $vrstica['image_url']
         ]);
      }
      echo '</div></div>';
      ?>

   </div>
   <a href="#" id="toTopBtn" style="display:none" onclick="topFunction()" class="cd-top text-replace js-cd-top cd-top--is-visible cd-top--fade-out" data-abc="true"></a>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

   <script>
      //Get the button:
      mybutton = document.getElementById("toTopBtn");

      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {
         scrollFunction()
      };

      function scrollFunction() {
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
         } else {
            mybutton.style.display = "none";
         }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
         document.body.scrollTop = 0; // For Safari
         document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
      }
   </script>

</body>

</html>


<?php
include "footer.php";
?>