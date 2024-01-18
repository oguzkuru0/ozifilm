<?php
include "baglan.php"; // Veritabanı bağlantısını sağlayan dosya

// GET parametresini kontrol etme ve güvenli hale getirme
$filmId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($filmId === 0) {
    die('Geçersiz film ID.');
}

// Sorguyu hazırla ve çalıştır
$filmQuery = $conn->prepare("SELECT * FROM korku_film WHERE korku_id=?");
$filmQuery->bind_param("i", $filmId);
$filmQuery->execute();

// Hata kontrolü
if ($filmQuery->error) {
    die('Sorgu hatası: ' . $filmQuery->error);
}

// Veriyi al
$film = $filmQuery->get_result()->fetch_assoc();

// Film bulunamadıysa hata göster
if (!$film) {
    die('Film bulunamadı.');
}

// Veritabanı bağlantısını kapatma
$filmQuery->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film İzleme Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: black;">

    <div class="movie-container">
        <div class="movie-player">
            <iframe width="100%" height="450" src="<?php echo htmlspecialchars($film['korku_kaynak']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="movie-details">
            <h2><?php echo htmlspecialchars($film['korku_isim']); ?></h2>
            <hr>
            <img class="movie-poster" src="images/<?php echo htmlspecialchars($film['korku_resim']); ?>" alt="Film Poster">
            <p><?php echo htmlspecialchars($film['korku_aciklama']); ?></p>
        </div>
    </div>

</body>
</html>
