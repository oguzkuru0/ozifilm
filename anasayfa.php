<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/logo.ico" type="image/x-icon">
  <title>OziFilm</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="navbar">
    <div class="navbar-wrapper">
      <div class="logo-wrapper">
        <h1 class="logo">OziFilm</h1>
      </div>
      <div class="menu-conteiner">
        <ul class="menu-list">
          <li class="menu-list-item active">Ana Sayfa</li>
          <li class="menu-list-item">Filmler</li>
          <li class="menu-list-item">Diziler</li>
          <li class="menu-list-item">Popüler</li>
        </ul>
      </div>
      <div class="profile-conteiner">
        <img class="image-picture" src="images/profile.jpg.JPG" alt="" />
        <div class="profile-text-conteiner">
          <a href="edit.php"><span class="profile-text">Log Out</span></a>
          <i class="bi bi-caret-down-fill"></i>
        </div>
        <div class="toggle">
          <i class="bi bi-moon-fill toggle-icon"></i>
          <i class="bi bi-brightness-high toggle-icon"></i>
          <div class="toggle-ball"></div>
        </div>
      </div>
    </div>
    <!-- ! navbar end -->
  </div>
  <!-- ! sidebar start -->
  <div class="sidebar">
    <i class="bi bi-search"></i>
    <i class="bi bi-house-door-fill"></i>
    <a href="communication/contactform.php"><i class="bi bi-telephone-fill"></i></a>
    <a href="kaydedilenler.php"><i class="bi bi-bookmarks-fill"></i></a>
    <i class="bi bi-gear-fill"></i>
  </div>
  <!-- ! sidebar end -->

  <!-- ! content start -->
  <div class="container">
    <!-- featured content start -->
    <div class="content-wrapper">
      <div class="featured-content"> <img class="featured-title" src="images/spiderman-title.png" alt="">
        <p class="featured-desc">Tüm Örümcek Adam filmlerinde olduğu gibi süper ses ve görüntü kalitesi ile yani full hd film izle seçeneği ile izleyeceğiniz Avengers Endgame’de yaşanan olaylardan sonra Parker ve arkadaşları dinlenmek ve kafalarını dağıtmak için Avrupa seyehatine giderler. Ancak bu gezi pek de dinlendirici geçmez çünkü Parker bu sefer de başlarına bela olan ve Mysterio adı verilen adamdan arkadaşlarını korumaya çalışır.</p>
        <div class="featured-buttons">
          <button class="play-button">
            <i class="bi bi-play-circle"></i>
            Oynat
          </button>
          <button class="info-button">
            <i class="bi bi-info-circle"></i>
            Daha Fazla Bilgi
          </button>
        </div>
      </div>
    </div>
    <!-- featured content end -->

    <!--  Filter Start -->
    <div class="movie-list-filter">
      <select>
        <option>korku</option>
        <option>popüler filmler</option>
        <option>yeni çıkan filmler</option>
      </select>
    </div>
    <!--  Filter End -->


    <div class="movie-list-cantainer">
      <h1 class="movie-list-title">Popüler Filmler</h1>
      <div class="movie-list-wrapper">
        <ul class="movie-list">

          <?php
          include "baglan.php";

          $sql = "SELECT * FROM populer_film";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $filmId = $row['populer_id']; // Film ID'sini al
          ?>
              <li class="movie-item">
                <img class="movie-item-img" src="images/<?php echo $row['populer_resim']; ?>">
                <div class="movie-info">
                  <span class="movie-item-title"><?php echo $row['populer_isim']; ?></span>
                  <div class="movie-item-buttons">
                    <a href="p_filmizle.php?id=<?php echo $filmId; ?>"><i class="bi bi-play-circle-fill"></i></a>
                    <form action="favori_ekle.php" method="post">
                      <input type="hidden" name="film_id" value="<?php echo $filmId; ?>">
                      <button type="submit">Favorilere Ekle</button>
                    </form>
                    <a href="index2.php"><i class="bi bi-chat-dots-fill"></i></a>
                  </div>
                </div>
              </li>
          <?php
            }
          } else {
            echo "Veri bulunamadı.";
          }
          ?>



        </ul>
        <i class="bi bi-chevron-right arrow"></i>
      </div>
    </div>
    <div class="movie-list-cantainer">
      <h1 class="movie-list-title">Yeni Çıkan Filmler</h1>
      <div class="movie-list-wrapper">
        <ul class="movie-list">
          <?php
          include "baglan.php";



          $sql = "SELECT * FROM yeni_film"; 
          $result = $conn->query($sql);

        
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $filmId = $row['yeni_id']; // Film ID'sini al
          ?>
              <li class="movie-item">
                <img class="movie-item-img" src="images/<?php echo $row['yeni_resim']; ?>">
                <div class="movie-info">
                  <span class="movie-item-title"><?php echo $row['yeni_isim']; ?></span>
                  <div class="movie-item-buttons">
                    <a href="y_filmizle.php?id=<?php echo $filmId; ?>"><i class="bi bi-play-circle-fill"></i></a>
                    <form action="favori_ekle.php" method="post">
                      <input type="hidden" name="film_id" value="<?php echo $filmId; ?>">
                      <button type="submit">Favorilere Ekle</button>
                    </form>
                    <a href="index2.php"><i class="bi bi-chat-dots-fill"></i></a>
                  </div>
                </div>
              </li>
          <?php
            }
          } else {
            echo "Veri bulunamadı.";
          }
          ?>

        </ul>
        <i class="bi bi-chevron-right arrow"></i>
      </div>
    </div>
    <div class="movie-list-cantainer">
      <h1 class="movie-list-title">Korku Filmleri</h1>
      <div class="movie-list-wrapper">
        <ul class="movie-list">

          <?php
          include "baglan.php";



          $sql = "SELECT * FROM korku_film"; 
          $result = $conn->query($sql);

          
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $filmId = $row['korku_id']; // Film ID'sini al
          ?>
              <li class="movie-item">
                <img class="movie-item-img" src="images/<?php echo $row['korku_resim']; ?>">
                <div class="movie-info">
                  <span class="movie-item-title"><?php echo $row['korku_isim']; ?></span>
                  <div class="movie-item-buttons">
                    <a href="k_filmizle.php?id=<?php echo $row['korku_id']; ?>"><i class="bi bi-play-circle-fill"></i></a>
                    <form action="favori_ekle.php" method="post">
                      <input type="hidden" name="film_id" value="<?php echo $filmId; ?>">
                      <button type="submit">Favorilere Ekle</button>
                    </form>
                    <a href="index2.php"><i class="bi bi-chat-dots-fill"></i></a>
                  </div>
                </div>
              </li>
          <?php
            }
          } else {
            echo "Veri bulunamadı.";
          }

          ?>



          <!-- ! content end -->

          <script src="script.js"></script>
</body>

</html>