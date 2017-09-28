<?php
include("../dbconnect.php");
function updateEnrollment($db){
    $sId = intval($_POST['studentId']);
    $cId = intval($_POST['courseId']);

    $res = enroll_student_in_course($sId, $cId, $db);
    return json_encode(array("courseId"=>$_POST['courseId'], "response" => $res, "id"=> is_int($sId)));
}

echo updateEnrollment($db);
?>