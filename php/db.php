<?php
header('Content-Type: application/json');


echo json_encode("Ciao");

$insert = "INSERT into queue values('$name');";

$delete = "DELETE from queue where name = $name";

$queuedNumber = "SELECT * from queue where name = $name";