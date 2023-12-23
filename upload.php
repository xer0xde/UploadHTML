<?php

$zielverzeichnis = "uploads/";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Ungültige Anfrage.");
}

if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
    die("Ungültige Datei.");
}

$file = $_FILES["fileToUpload"];
$erlaubteErweiterungen = ["jpg", "png", "jpeg", "gif", "zip"];
$zieldatei = $zielverzeichnis . basename($file["name"]);

if (file_exists($zieldatei)) {
    die("Die Datei existiert bereits.");
}

$erweiterung = strtolower(pathinfo($zieldatei, PATHINFO_EXTENSION));

if (!in_array($erweiterung, $erlaubteErweiterungen)) {
    die("Nur JPG, JPEG, PNG, GIF oder ZIP Dateien sind erlaubt.");
}

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

if (move_uploaded_file($file["tmp_name"], $zieldatei)) {
    echo "Die Datei " . basename($file["name"]) . " wurde hochgeladen.";
} else {
    echo "Es gab einen Fehler beim Hochladen der Datei.";
}

?>
