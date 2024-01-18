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

$user_id = $_SESSION['id'];

// Verileri çekmek için SQL sorgusu (INNER JOIN kullanımı)
$sql = "SELECT favoriler.*, populer_film.* FROM favoriler
        INNER JOIN populer_film ON favoriler.film_id = populer_film.populer_id WHERE user_id = '$user_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favori Filmler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            color: #007bff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 5px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Favori Filmler</h1>

        <?php
        // Verileri döngü ile alıp HTML kodu oluşturma
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo $row['film_id'] . " - " . $row['populer_isim'];
                echo "<img src='images/" . $row['populer_resim'] . "' alt='" . $row['populer_isim'] . "' class='movie-img' width='250' height='250'>";

                echo " <form action='favori_sil.php' method='post' style='display:inline;'>
                        <input type='hidden' name='favori_id' value='" . $row['id'] . "'>
                        <button type='submit' class='delete-btn'>Sil</button>
                      </form>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Veri bulunamadı.</p>";
        }
        ?>

        <a href="anasayfa.php">Ana Sayfa</a>
    </div>

    <!-- Bootstrap JS ve Popper.js dosyalarını ekleyebilirsiniz -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Veritabanı bağlantısını kapat
$conn->close();
?>