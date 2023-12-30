<?php
require 'lib/nusoap.php';
$client = new nusoap_client('http://localhost/ws/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
    echo '<h2>Constructor error</h2><pre>' . $err .'</pre>';
}

if (isset($_GET['id'])) {
    $updateID = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $response = $client->call('getUserByID', array("id" => $updateID));
    $res = json_decode($response, true);
}

if ($client->fault) {
    echo 'Error: ' . $client->fault;
}

if (isset($_POST['update'])) {
    $param = array(
        "idBarang" => $_POST['id'],
        "kodeBarang" => $_POST['kode'],
        "namaBarang" => $_POST['nama'],
        "satuanBarang" => $_POST['satuan'],
        "hargaBarang" => $_POST['harga'],
        "stokBarang" => $_POST['stok']
    );
    $update = $client->call('updateByID', array($param));
    if ($update) {
        echo 'Berhasil update data';
    } else {
        echo 'Gagal mengupdate!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update UKM</title>
</head>
<body>
    <?php
        echo '<form action="" method="POST">';
        echo '<h1>Create</h1>';
        echo '<table border=1>';
        echo '<tr><td>ID Barang</td><td><input type="number" name="id" value="' . $updateID . '" readonly="true"></td></tr>';
        echo '<tr><td>Kode Barang</td><td><input type="text" name="kode" value=""></td></tr>';
        echo '<tr><td>Nama Barang</td><td><input type="text" name="nama" value=""></td></tr>';
        echo '<tr><td>Satuan Barang</td><td><input type="text" name="satuan"  value=""></td></tr>';
        echo '<tr><td>Harga Barang</td><td><input type="number" name="harga"  value=""></td></tr>';
        echo '<tr><td>Stok Barang</td><td><input type="number" name="stok"  value=""></td></tr>';
        echo '<tr><td colspan="2" align="center"><input type="submit" name="update"></td></tr>';
        echo '</table>';
        echo '</form>';
    ?>
</body>
</html>
