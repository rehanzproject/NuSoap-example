<?php
require 'lib/nusoap.php';
$client = new nusoap_client('http://localhost/ws/server/server.php?wsdl', true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <h1>Create</h1>
    <table border=1>
        <tr><td>ID Barang</td><td><input type="number" name="id"></td></tr>
        <tr><td>Kode Barang</td><td><input type="text" name="kode"></td></tr>
        <tr><td>Nama Barang</td><td><input type="text" name="nama"></td></tr>
        <tr><td>Satuan Barang</td><td><input type="text" name="satuan"></td></tr>
        <tr><td>Harga Barang</td><td><input type="number" name="harga"></td></tr>
        <tr><td>Stok Barang</td><td><input type="number" name="stok"></td></tr>
        <tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
    </table>
</form>   
</body>
</html>

<?php
$err = $client->getError();
if ($err) {
    echo '<h2>Constructor error</h2><pre>' . $err .'</pre>';
}

if (isset($_POST['simpan'])) {
    $param = array(
        "idBarang" => $_POST['id'],
        "kodeBarang" => $_POST['kode'],
        "namaBarang" => $_POST['nama'],
        "satuanBarang" => $_POST['satuan'],
        "hargaBarang" => $_POST['harga'],
        "stokBarang" => $_POST['stok']
    );
    $result = $client->call("createData", array($param));
    if($result == null){
        echo "Gagal menambahkan data";
    }
}


?>
