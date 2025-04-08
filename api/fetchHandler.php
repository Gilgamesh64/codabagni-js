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
		$name = $_POST['name'];
		$bathroom_id = $_POST['bathroom'];
		$DBconn->insert($name, $bathroom_id);
		echo json_encode("Insert Successfull!");
		break;
	}
	case 'proceed': {
		$name = $_POST['name'];
		$bathroom_id = $_POST['bathroom'];
		if (!$DBconn->checkQueueTop($name, $bathroom_id)) {
			echo json_encode("You are not on top of the queue");
			exit();
		}
		$DBconn->queueGoOn($bathroom_id);
		echo json_encode("Queue proceeded!");
		break;
	}
	default: {
		http_response_code(400);
		echo json_encode("Operation not supported");
		die();
	}
}
