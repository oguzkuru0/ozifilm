<?php
session_start(); // Kullanıcı oturumunu başlat

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if (!isset($_SESSION['id'])) {
    die("Oturum açılmamış.");
}

$filmId = isset($_POST['film_id']) ? intval($_POST['film_id']) : 0;

if ($filmId === 0) {
    die("Hatalı veya eksik film ID değeri.");
}

// Favori eklemek için SQL sorgusu
$userId = $_SESSION['id'];

$sql = $conn->prepare("INSERT INTO favoriler (user_id, film_id) VALUES (?, ?)");
$sql->bind_param("ii", $userId, $filmId);

$response = [];

if ($sql->execute() === TRUE) {
    header('Location:anasayfa.php');
} else {
    $response['status'] = 'error';
    $response['message'] = 'Hata: ' . $sql->error;
}

header('Content-Type: application/json');
echo json_encode($response);

// Veritabanı bağlantısını kapat
$conn->close();
?>
