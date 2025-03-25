<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "codabagni");

$input_data = json_decode(file_get_contents('php://input'), true);

if(!isset($input_data['operation'])) exit;

if($input_data['operation'] == 'select') applySelect();
if($input_data['operation'] == 'insert') applyInsert();
if($input_data['operation'] == 'proceed') applyProceed();

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
    $name = $input_data['name'];
    $bathroom_id = $input_data['bathroom'];


    $sql = "INSERT INTO queue (name, bathroom) VALUES ('$name', '$bathroom_id')";
    mysqli_query($conn, $sql);

	echo json_encode("OK!");
}

function applyProceed() {
    global $conn, $input_data;

    $sql = "DELETE from queue limit 1";
    mysqli_query($conn, $sql);

	echo json_encode("OK!");
}