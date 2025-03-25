<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "codabagni");

$input_data = json_decode(file_get_contents('php://input'), true);

if(!isset($input_data['operation'])) exit;

if($input_data['operation'] == 'select') applySelect();
if($input_data['operation'] == 'insert') applyInsert();

function applySelect(){
	global $conn, $input_data;

	$output_data = [];
	
	$sql = "SELECT * from queue";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_row($result)){
		$output_data[] = $row;
	}

	mysqli_free_result($result);

	echo json_encode($output_data);

	exit();
}

function applyInsert(){
    global $conn, $input_data;
    $date = $input_data['date'];
    $client = $input_data['client'];

    mysqli_begin_transaction($conn);


    $sql = "INSERT INTO hoteldata (date, client) VALUES ('$date', '$client')";
    mysqli_query($conn, $sql);


    $sql = "SELECT date FROM hoteldata WHERE date='$date';";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_num_rows($result);

    if($data > 1){
        mysqli_rollback($conn);
        echo json_encode("Rollback");
    } 
    else{
        mysqli_commit($conn);
        echo json_encode("Commit");
    } 
}