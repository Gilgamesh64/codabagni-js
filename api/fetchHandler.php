<?php
header('Content-Type: application/json');



require_once 'DBconn.php';
$DBconn = DBconn::getInstance();

if (!isset($_POST['operation'])) {
	echo json_encode("No operation given");
	exit;
}

switch ($_POST['operation']) {
	case 'get_bathrooms': {
		echo json_encode($DBconn->getBathrooms());
		break;
	}
	case 'get_queue': {

		if(!isset($_COOKIE["bathroom"])){
			echo json_encode(("No bathroom selected"));
			exit();
		} 
		$bathroom_id = $_COOKIE["bathroom"];
		

		echo json_encode($DBconn->getQueues($bathroom_id));
		break;
	}
	case 'insert': {
		if(!isset($_COOKIE["bathroom"]) || !isset($_COOKIE["userID"])){
			echo json_encode(("No bathroom or user selected"));
			exit();
		} 
		$name = $_COOKIE["userID"];
		$bathroom_id = $_COOKIE["bathroom"];

		if($DBconn->isAlreadyInQueue($name, $bathroom_id)){
			echo json_encode("Already in queue");
			exit();
		}

		$DBconn->insert($name, $bathroom_id);
		echo json_encode("Insert Successfull!");
		break;
	}
	case 'is_in_queue': {
		if(!isset($_COOKIE["bathroom"]) || !isset($_COOKIE["userID"])){
			echo json_encode(("No bathroom or user selected"));
			exit();
		} 
		$name = $_COOKIE["userID"];
		$bathroom_id = $_COOKIE["bathroom"];

		if($DBconn->isAlreadyInQueue($name, $bathroom_id)){
			echo json_encode("true");
			exit();
		}
		echo json_encode("false");
		break;
	}
	case 'is_top': {
		if(!isset($_COOKIE["bathroom"]) || !isset($_COOKIE["userID"])){
			echo json_encode(("No bathroom or user selected"));
			exit();
		} 
		$name = $_COOKIE["userID"];
		$bathroom_id = $_COOKIE["bathroom"];

		if($DBconn->checkQueueTop($name, $bathroom_id)){
			echo json_encode("true");
			exit();
		}
		echo json_encode("false");
		break;
	}
	case 'exit': {
		if(!isset($_COOKIE["bathroom"]) || !isset($_COOKIE["userID"])){
			echo json_encode(("No bathroom or user selected"));
			exit();
		} 
		$name = $_COOKIE["userID"];
		$bathroom_id = $_COOKIE["bathroom"];
		
		$DBconn->exitQueue(name: $name, bathroom_id: $bathroom_id);
		echo json_encode("Operation successfull!");
		break;
	}

	
	default: {
		http_response_code(400);
		echo json_encode("Operation not supported");
		die();
	}
}
