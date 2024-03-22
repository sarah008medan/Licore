<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] !='login' ){
  echo "<script>
  alert('Anda belum login');
  location.href='../index.php';
  
  </script>";
}


?>



<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial scale=1">
        <title>WEBSITE GALERRY</title>
        <link rel = "stylesheet" type = "text/css" href ="../assets/css/bootstrap.min.css">
    </head>
    <body>

    <body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-danger-subtle bg-primary-subtle">
  <div class="container">
    <a class="navbar-brand" href="index.php"> Licore </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
    <div class="navbar-nav me-auto">
      <a href="home.php" class="nav-link"> Home </a>
        <a href = "album.php" class="nav-link">Album</a>
        <a href = "foto.php" class="nav-link">Foto</a>
        
      </div>
      
        <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">
        Keluar</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-header">Tambah Album</div>
                <div class="card-body">
                    <form action="../config/aksi_album.php" method="POST">
                        <label class="form-label">Nama Album</label>
                        <input type="text" name="namaalbum" class="form-control" required>
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                        <button type = "submit" class="btn btn-primary mt-2" name="tambah">Tambah data</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">Data album</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi, "SELECT * from album WHERE userid='$userid' ");
                            while($data = mysqli_fetch_array($sql)){

                            
                            ?>
                            <tr>
                                <td><?php echo $no++?></td>
                                <td><?php echo $data['namaalbum']?></td>
                                <td><?php echo $data['deskripsi']?></td>
                                <td><?php echo $data['tanggaldibuat']?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>"> Edit </button>
                  <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit Data </h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
      <div class="modal-body">
        <form action="../config/aksi_album.php" method = "POST">
            <input type="hidden" name="albumid" value = "<?php echo $data['albumid'] ?>" >
            <label class="form-label">Nama album</label>
                        <input type="text" name="namaalbum" value ="<?php echo $data['namaalbum'] ?>" class="form-control" required>
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required> 
                        <?php echo $data['deskripsi'];?>
                        </textarea>

       
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit" class="btn btn-primary">Edit data</button>
        </form>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>"> Hapus </button>
                  <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel"> Hapus Data </h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
      <div class="modal-body">
        <form action="../config/aksi_album.php" method = "POST">
            <input type="hidden" name="albumid" value = "<?php echo $data['albumid'] ?>" >
          Apakah anda yakin ingin menghapus data <strong><?php echo $data['albumid']?></strong> ?
                        

       
      </div>
      <div class="modal-footer">
        <button type="submit" name="hapus" class="btn btn-primary">Hapus data</button>
        </form>
      </div>
    </div>
  </div>
</div>

                                </td>
                            </tr>
                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
 </div>

<script type = "text/javascript" src="../assets/js/bootstrap.min.js"></script>
                            </body>

<footer class ="d-flex justify-content-center border-top mt-3 bg-primary-subtle
bg-light fixed-bottom">
<p>&copy;ukk RPL 2024 | Sarah</P>
</footer>
        <script type = "text/javascript" src="../assets/js/bootstrap.min.js"></script>
        
    </body>
</html>

                            