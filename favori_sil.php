<?php
session_start(); // Kullanıcı oturumunu başlat

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Kullanıcının oturumunu kontrol et
if (!isset($_SESSION['id'])) {
    die("Oturum açılmamış.");
}

// Formdan gelen favori ID'sini al
$favoriId = isset($_POST['favori_id']) ? intval($_POST['favori_id']) : 0;

// Favori ID'si boşsa veya 0 ise hata mesajını göster
if ($favoriId === 0) {
    die("Hatalı veya eksik favori ID değeri.");
}

// Favoriyi silmek için SQL sorgusu
$userId = $_SESSION['id'];
$sql = $conn->prepare("DELETE FROM favoriler WHERE id = ? AND user_id = ?");
$sql->bind_param("ii", $favoriId, $userId);

$response = [];

if ($sql->execute() === TRUE) {
    header('Location:kaydedilenler.php');
} else {
    $response['status'] = 'error';
    $response['message'] = 'Hata: ' . $sql->error;
}

// JSON formatında cevap gönder
header('Content-Type: application/json');
echo json_encode($response);

// Veritabanı bağlantısını kapat
$conn->close();
?>
