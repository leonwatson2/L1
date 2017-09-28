<?php 

include("../../header.php");
include("../../dbconnect.php");
if(isset($_GET['id']) && isset($_GET['name'])){
    $id = $_GET['id'];
    $name = $_GET['name'];
}else{
    header("Location: ../");
}

if(isset($_POST['name']) && isset($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    if(strlen($name) > 0){
        $done = update_lecturer($id, $name, $db);
    }else{
        $done = false;
    }
}

?>
<h3>Edit Lecturer</h3>

<form action="" method="post">
    <? 
        if(isset($done)){
            if($done){
            
            ?>
        
            <div class="card green lighten-1"> 
                <div class="card-content">
                    <span>Updated <?= $name ?></span>
                </div>
            </div>
        <? }else{ ?>
            <div class="card red darken-2"> 
                <div class="card-content">
                    <span>Couldn't update <?= $name ?></span>
                </div>
            </div>
         <?} ?>

    <?  }?>
    <div class="input-field">
        <input readonly type="number" name="id" value="<?= $id ?>"/>
        <label for="name">ID</label>
    </div>
    <div class="input-field">
        <input type="text" name="name" value="<?= $name ?>" placeholder="Lecturers Name"/>
        <label for="name">Name</label>
    </div>
    <div class="input-field">
        <button class="btn btn-waves">Submit</button>
    </div>
</form>

<? 
include("../../footer.php");
?>