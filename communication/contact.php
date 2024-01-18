<?php
// Veritabanı bağlantı parametreleri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form gönderimini işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Veritabanına veri eklemek için SQL sorgusu
    $sql = "INSERT INTO contact (name, mobile, email, message) VALUES ('$name', '$mobile', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Mesaj başarıyla gönderildi!";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
