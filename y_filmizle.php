<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}


// GET parametresini kontrol etme ve güvenli hale getirme
$filmId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Sorguyu hazırla ve çalıştır
$filmQuery = $conn->prepare("SELECT * FROM yeni_film WHERE yeni_id=?");
$filmQuery->bind_param("i", $filmId);
$filmQuery->execute();



// Hata kontrolü


// Veriyi al
$filmResult = $filmQuery->get_result();

// Film bulunamadıysa hata göster
if (!$filmResult) {
    die("Film bulunamadı.");
}

// Veriyi al
$film = $filmResult->fetch_assoc();

// $film dizisinin null olup olmadığını kontrol et
if ($film === null) {
    die("Film bulunamadı.");
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
            <iframe width="100%" height="450" src="<?php echo htmlspecialchars($film['yeni_kaynak']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="movie-details">
            <h2><?php echo htmlspecialchars($film['yeni_isim']); ?></h2>
            <hr>
            <img class="movie-poster" src="images/<?php echo htmlspecialchars($film['yeni_resim']); ?>" alt="Film Poster">
            <p><?php echo htmlspecialchars($film['yeni_aciklama']); ?></p>
        </div>
    </div>

</body>
</html>
