<?php

require_once 'DBconn.php';
$DBconn = DBconn::getInstance();

include 'fetchData.php';

header('Content-Type: application/json', true, 200);

function rejectNoAction()
{
	echo json_encode("No Action");
	exit();
}

function rejectNotLogged()
{
	http_response_code(401);
	echo json_encode("Not Logged");
	exit();
}

function rejectBadAuth()
{
	http_response_code(401);
	echo json_encode("Bad Auth Error");
	exit();
}

function rejectSessionExpired()
{
	echo json_encode("Session expired");
	exit();
}

function rejectNoBathroom()
{
	http_response_code(400);
	echo json_encode("Unselected Bathroom");
	exit();
}

function rejectInQueue()
{
	http_response_code(400);
	echo json_encode("Already in queue");
	exit();
}

if ($action == "") rejectNoAction();

if ($user == "") rejectNotLogged();

switch ($DBconn->checkToken($user, $token)) {
	case 1: {
			rejectBadAuth();
			break;
		}
	case 2: {
			rejectSessionExpired();
			break;
		}
}

switch ($action) {
	case 'get_bathrooms': {
			echo json_encode($DBconn->getBathrooms());
			break;
		}
	case 'get_queue': {
			if ($bathroom == "") rejectNoBathroom();

			echo json_encode($DBconn->getQueues($bathroom));
			break;
		}
	case 'insert': {
			if ($bathroom == "") rejectNoBathroom();

			if ($DBconn->isInQueue($user, $bathroom)) rejectInQueue();

			$DBconn->insert($user, $bathroom);
			echo json_encode("Insert Successfull!");
			break;
		}
	case 'is_in_queue': {
			if ($bathroom == "") rejectNoBathroom();

			if ($DBconn->isInQueue($user, $bathroom)) {
				echo json_encode("true");
				exit();
			}
			echo json_encode("false");
			break;
		}
	case 'is_top': {
			if ($bathroom == "") rejectNoBathroom();

			if ($DBconn->checkQueueTop($user, $bathroom)) {
				echo json_encode("true");
				exit();
			}
			echo json_encode("false");
			break;
		}
	case 'exit': {
			if ($bathroom == "") rejectNoBathroom();

			$DBconn->exitQueue($user, $bathroom);
			echo json_encode("Operation successfull!");
			break;
		}
	default: {
			http_response_code(400);
			echo json_encode("Operation not supported");
			die();
		}
}
