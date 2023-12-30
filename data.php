<?php

function get_price($name)
{
	$products = [
		"book"=>20,
		"pen"=>10,
		"pencil"=>5
	];
	
	foreach($products as $product=>$price)
	{
		if($product==$name)
		{
			return $price;
		}
	}
}
function getUserByID($id)
{
    $con = mysqli_connect("localhost", "root", "", "ukm");
    if (mysqli_connect_errno()) {
        return "Failed to connect: " . mysqli_connect_error();
    }
    $result = mysqli_query($con, 'SELECT * FROM barang WHERE idBarang = ' .$id . '');
    if (!$result) {
        return "Query failed: " . mysqli_error($con);
    }
    if (mysqli_num_rows($result) >= 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
		return json_encode($response);
    } else {
        return "No data";
    }
}

function getAllUser($id)
{
	$con = mysqli_connect("localhost","root","", "ukm");
	if(mysqli_connect_errno()){
		echo "Failed to Connect :".mysqli_connect_error();
		die();
	}
	$result = mysqli_query($con,"SELECT * FROM barang ");
	if(mysqli_num_rows($result)> 0){
		while($row = mysqli_fetch_assoc($result)){
		$response[] = $row;

		}
		return json_encode($response);

	} else {
		return "no data";
	}
}

function deleteByID($id)
{
	$con = mysqli_connect("localhost","root","", "ukm");
	if(mysqli_connect_errno()){
		echo "Failed to Connect :".mysqli_connect_error();
		die();
	}
	$result = mysqli_query($con, "DELETE FROM barang WHERE idBarang = " . $id . "");	
	if($result == null ){
		return "no data";
	}
	return $result;
}

function createData($param)
{
    $con = mysqli_connect("localhost", "root", "", "ukm");
    if (mysqli_connect_errno()) {
        echo "Failed to Connect: " . mysqli_connect_error();
        die();
    }
    $result = mysqli_query($con, "INSERT INTO barang 
        (idBarang, kodeBarang, namaBarang, satuanBarang, hargaBarang, stokBarang)
        VALUES ($param[idBarang], '$param[kodeBarang]', '$param[namaBarang]', '$param[satuanBarang]', $param[hargaBarang], $param[stokBarang])");
	
	if($result == null ){
	return "no data";
	}
	return $result;

}

function updateByID($param)
{
    $con = mysqli_connect("localhost", "root", "", "ukm");
    if (mysqli_connect_errno()) {
        echo "Failed to Connect: " . mysqli_connect_error();
        die();
    }

    $updateQuery = "UPDATE barang SET
        kodeBarang = '{$param['kodeBarang']}',
        namaBarang = '{$param['namaBarang']}',
        satuanBarang = '{$param['satuanBarang']}',
        hargaBarang = {$param['hargaBarang']},
        stokBarang = {$param['stokBarang']}
        WHERE idBarang = {$param['idBarang']}";

    $result = mysqli_query($con, $updateQuery);

    if ($result == null) {
        return "no data";
    }
    return $result;
}

