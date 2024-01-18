<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen verileri alma
$adSoyad = $_POST['adSoyad'];
$yorum = $_POST['yorum'];

// SQL sorgusu ile veritabanına ekleme
$sql = "INSERT INTO yorumlar (adSoyad, yorum) VALUES ('$adSoyad', '$yorum')";

if ($conn->query($sql) === TRUE) {
    echo "Yorum başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
