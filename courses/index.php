<?php 
    include('../dbconnect.php');

    include('../header.php');
    $id = null;
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $mainCourse = get_course($id, $db);
    }
    $courses = get_courses($db);
    ?>

    <h2>Courses</h2>

    <div class="row">
       <? include('course-list.php'); ?>

    <?php if(isset($mainCourse)){ ?>
        <? include('course.php'); ?>
    <? } ?>
    </div>
<?

include('../footer.php');