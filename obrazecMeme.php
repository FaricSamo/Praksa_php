<?php
include "header.php";
?>

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

<body class="d-flex flex-column min-vh-100">

    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <h3>Novi meme</h3>
            <div class="form-group">
                <label for="naslov">Naslov</label>
                <input name="naslov" type="text" class="form-control" id="naslov" placeholder="Vnesi naslov">
            </div>
            <div class="form-group">
                <label for="opis">Opis</label>
                <textarea name="opis" type="text" class="form-control" id="opis" placeholder="Opis"></textarea>
            </div>
            <div class="form-group">
                <label for="file">Izberite datoteko</label>
                <input name="my_file" type="file" class="form-control-file" id="file">
            </div>
            <p><input class="btn btn-success" type="submit" value="Dodaj" name="submit" /></p>
        </form>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    // collect value of input field
    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];
    $potSlika = "";
    if (empty($opis) || empty($naslov)) {
        echo "Dopolnite manjkajoče podatke";
    } else {
    
        if (($_FILES['my_file']['name'] != "")) {
            // Where the file is going to be stored
            $target_dir = "upload/";
            $file = $_FILES['my_file']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['my_file']['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;

            move_uploaded_file($temp_name, $path_filename_ext);
        }

        $db = mysqli_connect("localhost", "root", "", "memelibrary");
        if (!$db) {
            die('Could not connect: ' . mysqli_connect_error());
        } else {
            $naslov = mysqli_real_escape_string($db, $naslov);
            $opis = mysqli_real_escape_string($db, $opis);
            $potSlika = mysqli_real_escape_string($db, $path_filename_ext);
            $sql_ukaz = "INSERT INTO memes (title, description, image_url) VALUES ('{$naslov}', '{$opis}', '{$potSlika}');";
            mysqli_query($db, $sql_ukaz);
        }
        mysqli_close($db);

        echo '<div class="container"><div id="sporocilo" class="alert alert-success" role="alert">Meme je uspešno dodan!</div></div>';
        echo '<script>$(function(){ setTimeout(function() { $("#sporocilo").hide("slow"); }, 3000); });</script>';
    }
}
?>

<?php
include "footer.php";
?>