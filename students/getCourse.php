<?php
include("../dbconnect.php");


echo json_encode(get_course(intval($_POST['courseId']), $db));
?>