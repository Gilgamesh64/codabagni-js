<?php
header('Content-Type: application/json');



require_once 'DBconn.php';
$DBconn = DBconn::getInstance();

if (!isset($_POST['operation'])) {
	echo json_encode("NO FUCKING OPERATION GIVEN DICKHEAD");
	exit;
}

switch ($_POST['operation']) {
	case 'select': {
		echo json_encode($DBconn->getQueues());
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
		echo json_encode("KILL YOURSELF");
		die();
	}
}
