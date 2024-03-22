<?php
session_start();
$userid = $_SESSION['userid'];
include'../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
  echo "<script>
  alert('Anda belum login!');
  location.href='../index.php';
  </script>";
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Website Galeri Foto </title>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body class="bg-light ">
<nav class="navbar navbar-expand-lg navbar-danger-subtle bg-primary-subtle">
    <div class="container">
      <a class="navbar-brand" href="index.php">Licore </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto">
          <a href="home.php" class="nav-link"> Home </a>
          <a href="album.php" class="nav-link"> Album </a>
          <a href="foto.php" class="nav-link"> Foto </a>    
        </div>
        
        <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1"> Keluar </a>
      </div>
    </div>
  </nav>

  <div class="container mt-3">
    Album :
  <?php
  $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
  while($row = mysqli_fetch_array($album)) { ?>
  <a href ="home.php?albumid=<?php echo $row['albumid'] ?>" class ="btn btn-outline-secondary"> 
  <?php echo $row['namaalbum'] ?></a>
    
  <?php } ?>
  
  <div class="row">
      <?php 
    if (isset($_GET['albumid'])) {
    $albumid  = $_GET['albumid'];
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
    while($data = mysqli_fetch_array($query)) { ?>
      
        <div class="col-md-3">
          <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid']?>">
            <div class="card">
              <img style ="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
              <div class="card-footer text-center">
        <?php
        $fotoid = $data['fotoid'];
        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
        
        if (mysqli_num_rows($ceksuka) == 1) { ?>
        <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="batalsuka"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
  <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
</svg></a>
        
        <?php } else { ?>
        <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" name="suka"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
  <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
</svg></a>
        
        <?php }
        $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($like). ' ';
        ?>
       
        
        
     
        
                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid']?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
  <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
</svg></a>
                <?php
                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($jmlkomen).' ';
                ?>
              </div>
            </div>
          </a>

          <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">  
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-body">
                 <div class="row">
                  <div class="col-md-4">
                    <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                  </div>
                  <div class="col-md-4"></div> 
                  <div class="m-2">
                    <div class="overflow-auto">
                      <div class="sticky-top">
                        <strong><?php echo $data['judulfoto'] ?></strong><br>
                        <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                      </div>
                      <hr>
                      <p align ="left">
                        <?php echo $data['deskripsifoto'] ?>
                      </p>
                      <hr>
                      <?php
                      $fotoid = $data['fotoid'];
                      $komentar = mysqli_query($koneksi,"SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                      while($row = mysqli_fetch_array($komentar)){
                      ?>
                      <p align ="left">
                        <strong><?php echo $row['nama_lengkap'] ?></strong>
                        <?php echo $row['isikomentar'] ?>
                      </p>
                    <?php } ?>
                    <hr>
                    <div class="sticky-bottom">
                      <form action="../config/proses_komentar.php" method="POST">
                        <div class="input-group">
                          <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                          <input type="text" name="isikomentar" class="form-control" placeholder="Tambah komentar">
                          <div class="input-group-prepend">
                           <button type="submit" name="kirimkomentar" class="btn btn-outline-secondary"> Kirim </button>
                         </div>
                       </div>
                     </form>
                   </div>
                 </div>
               </div>

             </div>
           </div>
         </div>
       </div>
     </div>

   </div>
    <?php } } ?>
</div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-primary-subtle fixed-bottom">
<p>&copy; ukk RPL 2024 | Sarah </p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>