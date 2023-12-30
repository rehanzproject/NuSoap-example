<?php
require 'lib/nusoap.php';
$client = new nusoap_client("http://localhost/ws/server/service.php?wsdl"); // Create a instance for nusoap client

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Website UKM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Website UKM</h2>
  <h3>
  <?php
  	$response = $client->call('getAllUser',array("id"=>1));
    $result = json_decode($response, true);
    if($result == null){
      echo "Gagal mendapatkan data";
    }
  if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $response = $client->call('deleteByID', array("id" => $deleteId));
   if(isset($response["error"])) {
    echo "<h1> " .$response. "</h1>";
   
  }
  echo "Data berhasil dihapus";
  }

echo "<a href='create.php'>Create</a>";
echo '<table border=1>';
echo '<tr>';
echo '<th>ID</th> ' ;
echo '<th>Kode</th> ' ;
echo '<th>Nama</th> ' ;
echo '<th>Satuan</th> ' ;
echo '<th>Harga</th> ' ;
echo '<th>Stok</th> ' ;
echo '<th colspan=3>Aksi</th> ' ;
echo '</tr> ' ;
foreach ($result as $item) {
echo '<tr>';
    echo '<td>' . $item['idBarang'] . '</td>';
    echo '<td>' . $item['kodeBarang'] . '</td>';
    echo '<td>' . $item['namaBarang'] . '</td>';
    echo '<td>' . $item['satuanBarang'] . '</td>';
    echo '<td>' . $item['stokBarang'] . '</td>';
    echo '<td>' . $item['hargaBarang'] . '</td>';
    echo '<td><a href="read.php?id=' . $item['idBarang'] . '">Read</a></td>';
    echo '<td><a href="update.php?id=' . $item['idBarang'] . '">Update</a></td>';
    echo '<td><a href="?delete=' . $item['idBarang'] . '">Delete</a></td>';
    echo '</tr>';
}
echo '</table>';
        
   ?>
  </h3>
</div>
</body>
</html>