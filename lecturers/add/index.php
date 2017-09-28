<?php 

include("../../header.php");
include("../../dbconnect.php");
if(isset($_POST['name'])){
    $name = $_POST['name'];
    if(strlen($name) > 0){
        add_lecturer($name, $db);
    }
}
?>
<h3>Add Lecturer</h3>

<form action="" method="post">
    <div class="input-field">
        <input type="text" name="name" placeholder="Lecturers Name"/>
        <label for="name">Name</label>
    </div>
    <div class="input-field">
        <button class="btn btn-waves">Submit</button>
    </div>
</form>

<? 
include("../../footer.php");
?>