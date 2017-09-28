<?php 
$username="root";
$password="";
$database="classes";
 $db = mysqli_connect('localhost',$username, $password, $database)
or die('Error connecting to MySQL server.');

function get_courses($db){
    $qry = "SELECT courseID id, courseName name, courseCampus campus, courseFee fee from courses";

    $res = $db->query($qry);
    $courses = array();
    while ($course = $res->fetch_assoc()) {
        $course['units'] = get_course_units($course['id'], $db);
        array_push($courses, $course);
    }

    return $courses;        

}

function get_course($id, $db){
    $qry = "SELECT courseID id, 
                courseName name, 
                courseCampus campus, 
                courseFee fee 
                from courses 
                WHERE courseID = $id";

    $res = $db->query($qry);
    $courses = array();
    while ($course = $res->fetch_assoc()) {
        $course['units'] = get_course_units($course['id'], $db);
        array_push($courses, $course);
    }
    if(count($courses) > 0 ){
        return $courses[0];        
    }   
    return NULL;

}
function get_course_units($courseID, $db){
    

    $qry = "SELECT 
            unitID id, 
            unitName name, 
            unitYear year, 
            lecturerID lecturerId 
            FROM units WHERE units.courseID = $courseID";
    $result = $db->query($qry);

    $units = array();
    while($unit = $result->fetch_assoc()){
        array_push($units, $unit);
    }
    return $units;
}

function get_lecturers($db){
    $qry = "SELECT lecturerID id, 
            lecturerName name
            from lecturers";
    
    $res = $db->query($qry);
    $lecturers = array();
    while ($lecturer = $res->fetch_assoc()) {
        $lecturer['units'] = get_lecturer_units($lecturer['id'], $db);
        array_push($lecturers, $lecturer);
    }

    return $lecturers; 
    
}
function get_lecturer_units($id, $db){
    $qry = "SELECT unitID id, 
            unitName name, 
            unitYear year, 
            lecturerID lecturerId 
            FROM units WHERE units.lecturerID = $id";
    $result = $db->query($qry);

    $units = array();
    while($unit = $result->fetch_assoc()){
        array_push($units, $unit);
    }
    return $units;

}
function get_lecturer($id, $db){
    $qry = "SELECT lecturerID id, 
            lecturerName name
            from lecturers 
            WHERE lecturerID = $id";

    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    $lecturers = array();
    while ($lecturer = $res->fetch_assoc()) {
        $lecturer['units'] = get_lecturer_units($lecturer['id'], $db);
        array_push($lecturers, $lecturer);
    }

    return $lecturers[0];        
}

function add_lecturer($name, $db){
    $qry = "INSERT INTO `lecturers` (`lecturerID`, `lecturerName`) VALUES (NULL, '$name')";
    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    return $res;
}
function update_lecturer($id, $name, $db){
    $qry = "UPDATE `lecturers` SET `lecturerName` = '$name' WHERE `lecturers`.`lecturerID` = $id";
    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    return $res;
}
function delete_lecturer($id, $db){
    $qry = "DELETE FROM `lecturers` WHERE lecturerID = $id";
    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    return $res;
}
function get_students($db){
    $qry = "SELECT studentName name, studentID id from students";
    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    $students = array();
    while($student = $res->fetch_assoc()){
        $student['classes'] = array();
        array_push($students, $student);
    }

    return $students;

}
function get_student($id, $db){
    $qry = "SELECT studentName name, 
            studentID id, 
            studentAddress address,
            studentEmail email,
            studentTelNo phone,
            courseID from students WHERE studentID = '$id'";

    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    $students = array();
    while ($student = $res->fetch_assoc()) {
        if($student['courseID'] != null)
            $student['course'] = get_course($student['courseID'], $db);
        array_push($students, $student);
    }        
    return $students[0];
}
function add_student($student, $db){
    $qry = "INSERT INTO students (studentName, studentAddress, studentEmail, studentTelNo, courseID) 
            VALUES ('$student->name',
                    '$student->address',
                    '$student->email',
                    '$student->phone',
                    '$student->courseID'
                    )";
    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    return $res;

}

function enroll_student_in_course($studentID, $courseID, $db){
    $qry = "UPDATE students SET courseID = '$courseID' WHERE studentID = '$studentID'";
    $res = $db->query($qry);
    if(!$res){
        var_dump($db->query);
    }
    return $res;

}
function get_students_enrolled_in($id, $db){
    $qry = "SELECT studentName name, 
            studentID id, 
            studentAddress address,
            studentEmail email,
            studentTelNo phone FROM students WHERE courseID = $id";

    $res = $db->query($qry);
    if(!$res){
        var_dump($db->error);
    }
    $students = array();
    while ($student = $res->fetch_assoc()) {
        array_push($students, $student);
    }        
    return $students;
}
?>