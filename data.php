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

    if ($result) {
        echo "Data inserted successfully";
       return json_encode($result);
    } else {
        echo "Error: " . mysqli_error($con);
    }

}