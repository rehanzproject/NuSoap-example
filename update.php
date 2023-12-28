<?php
require 'lib/nusoap.php';
$client = new nusoap_client('http://localhost/ws/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
    echo '<h2>Constructor error</h2><pre>' . $err .'</pre>';
}
if (isset($_GET['id'])) {
$updateID = isset($_GET['id']) ? intval($_GET['id']) : 0;
$response = $client->call('getUserByID', array("id"=>$updateID));
$res= json_decode($response, true);
}
if ($client->fault) {
    echo 'Error: '.$client->fault;
} else {
    $err = $client->getError();
    if ($err) {
        echo 'Error: '.$err;
    } else {
        if ($result == null) {
            echo 'Data failed';
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
            $result = $client->call("updateData", array($param));
            if ($result == null) {
                echo "Gagal menambahkan data";
            }
        }

        foreach ($res as $item) {
            echo '<form action="" method="POST">';
            echo '<h1>Create</h1>';
            echo '<table border=1>';
            echo '<tr><td>ID Barang</td><td><input type="number" name="id" value="'.$updateID.'" readonly="true"></td></tr>';
            echo '<tr><td>Kode Barang</td><td><input type="text" name="kode" value="'.$item['kodeBarang'].'"></td></tr>';
            echo '<tr><td>Nama Barang</td><td><input type="text" name="nama" value="'.$item['namaBarang'].'"></td></tr>';
            echo '<tr><td>Satuan Barang</td><td><input type="text" name="satuan"  value="'.$item['satuanBarang'].'"></td></tr>';
            echo '<tr><td>Harga Barang</td><td><input type="number" name="harga"  value="'.$item['hargaBarang'].'"></td></tr>';
            echo '<tr><td>Stok Barang</td><td><input type="number" name="stok"  value="'.$item['hargaBarang'].'"></td></tr>';
            echo '<tr><td colspan="2" align="center"><input type="submit" name="update"></td></tr>';
            echo '</table>';
            echo '</form>';
        }
    }
}
?>
