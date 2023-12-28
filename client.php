<?php
require 'lib/nusoap.php';

$client = new nusoap_client("http://localhost/ws/server/service.php?wsdl"); // Create a instance for nusoap client

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SOAP Web Service Client Side Demo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>SOAP Web Service Client Side Demo</h2>
  <form class="form-inline" action="" method="POST">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="number" name="id" class="form-control"  placeholder="Enter Product Name" required/>
    </div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
  <p>&nbsp;</p>
  <h3>
  <?php
	if(isset($_POST['submit']))
	{
		$id = $_POST['id'];
		$response = $client->call('getUserByID',array("id"=>$id));
        $result = json_decode($response, true);
        if ($result != null){
            echo "<a href='create.php'>Create</a>";
echo '<table border=1>';
echo '<tr>';
echo '<th>ID</th> ' ;
echo '<th>Kode</th> ' ;
echo '<th>Nama</th> ' ;
echo '<th>Satuan</th> ' ;
echo '<th>Harga</th> ' ;
echo '<th>Stok</th> ' ;
echo '</tr> ' ;
foreach ($result as $item) {
echo '<tr>';
    echo '<td>' . $item['idBarang'] . '</td>';
    echo '<td>' . $item['kodeBarang'] . '</td>';
    echo '<td>' . $item['namaBarang'] . '</td>';
    echo '<td>' . $item['satuanBarang'] . '</td>';
    echo '<td>' . $item['stokBarang'] . '</td>';
    echo '<td>' . $item['hargaBarang'] . '</td>';
echo '</tr>';

}
echo '</table>';
        }
	}
   ?>
  </h3>
</div>
</body>
</html>