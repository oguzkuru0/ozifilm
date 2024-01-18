<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Yorum Ekle</title>
</head>
<body>
    <div class="container">
        <h2>Yorum Ekle</h2>
        <form action="yorum_ekle.php" method="post">
            <label for="adSoyad">Ad Soyad:</label>
            <input type="text" id="adSoyad" name="adSoyad" required><br>

            <label for="yorum">Yorum:</label>
            <textarea id="yorum" name="yorum" rows="4" required></textarea><br>

            <input type="submit" value="Yorumu Gönder">
        </form>
    </div>
</body>
</html>
