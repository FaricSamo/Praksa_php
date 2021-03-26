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
        <?php
        $idMeme = $_GET['meme'];

        $dom = new DOMDocument('1.0'); //Create new document with specified version number

        $glavniDiv = $dom->createElement('div');
        $dom->appendChild($glavniDiv);
        $glavniDivAtr = $dom->createAttribute('class');
        $glavniDivAtr->value = 'container my-2 t1';
        $glavniDiv->appendChild($glavniDivAtr);

        $rowDiv = $dom->createElement('div');
        $glavniDiv->appendChild($rowDiv);
        $rowDivAtr = $dom->createAttribute('class');
        $rowDivAtr->value = 'row';
        $rowDiv->appendChild($rowDivAtr);

        $db = mysqli_connect("localhost", "root", "", "memelibrary");
        if (!$db) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        $rezultat = mysqli_query($db, "SELECT * FROM memes WHERE id='{$idMeme}';");
        while ($vrstica = mysqli_fetch_assoc($rezultat)) {

            $colDiv = $dom->createElement('div');
            $rowDiv->appendChild($colDiv);
            $colDivAtr = $dom->createAttribute('class');
            $colDivAtr->value = 'col-sm-12 col-md-4';
            $colDiv->appendChild($colDivAtr);
            $styleDiv = $dom->createAttribute('style');
            $styleDiv->value = 'margin-bottom: 10px;';
            $colDiv->appendChild($styleDiv);

            $cardDiv = $dom->createElement('div');
            $colDiv->appendChild($cardDiv);
            $cardDivAtr = $dom->createAttribute('class');
            $cardDivAtr->value = 'card';
            $cardDiv->appendChild($cardDivAtr);

            $img = $dom->createElement('img');
            $cardDiv->appendChild($img);
            $imgAtr = $dom->createAttribute('class');
            $imgAtr->value = 'card-img-top';
            $img->appendChild($imgAtr);
            $src = $dom->createAttribute('src');
            $src->value = $vrstica['image_url'];
            $img->appendChild($src);
            $alt = $dom->createAttribute('alt');
            $alt->value = "Meme image";
            $img->appendChild($alt);
            $style = $dom->createAttribute('style');
            $style->value = 'height: 400px;';
            $img->appendChild($style);

            $cardBDiv = $dom->createElement('div');
            $cardDiv->appendChild($cardBDiv);
            $cardBDivAtr = $dom->createAttribute('class');
            $cardBDivAtr->value = 'card-body';
            $cardBDiv->appendChild($cardBDivAtr);

            $p = $dom->createElement('p');
            $cardBDiv->appendChild($p);
            $pAtr = $dom->createAttribute('class');
            $pAtr->value = 'card-text';
            $p->appendChild($pAtr);

            $strong = $dom->createElement('strong', $vrstica['title']);
            $p->appendChild($strong);

            $p2 = $dom->createElement('p', $vrstica['description']);
            $cardBDiv->appendChild($p2);
            $pAtr2 = $dom->createAttribute('class');
            $pAtr2->value = 'card-text';
            $p2->appendChild($pAtr2);
        }
        echo $dom->saveHTML();        //Outputs the generated source code

        echo '<div class="container" style="margin-top: 5px;">';
        echo '<h5>Ali ste prepričani, da želite izbrisati izbrani meme?</h5>';
        echo '<a href="?da&id=' . $idMeme . '" class="btn btn-danger" name="btnDa">Da</a>';
        echo '<a href="http://localhost/index.php" class="btn btn-info" name="btnNe">Ne</a>';
        echo '</div>';

        if (isset($_GET['da'])) {
            $id = $_GET['id'];
            // Create connection
            $db = mysqli_connect("localhost", "root", "", "memelibrary");
            if (!$db) {
                die('Could not connect: ' . mysqli_connect_error());
            }

            // sql to delete a record
            $sql = "DELETE FROM memes WHERE id='{$id}'";

            if (mysqli_query($db, $sql)) {
                echo "<script> location.href='http://localhost/index.php'; </script>";
                exit;
            } else {
                echo "Error deleting record: " . mysqli_error($db);
            }
            mysqli_close($db);
            
        }
        ?>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>


<?php
include "footer.php";
?>