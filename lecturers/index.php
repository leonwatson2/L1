<?php 
    include('../dbconnect.php');

    include('../header.php');
    $id = null;
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $mainLecturer = get_lecturer($id, $db);
    }
    $lecturers = get_lecturers($db);
    ?>

    <h2>lecturers</h2>

    <div class="row">

        <div class="col s5 collection with-header">
            <?php
            foreach($lecturers as $lecturer){
                ?>
                <div class="collection-header">
                    <h4>
                        <a href="?id=<?=$lecturer["id"] ?>">
                            <?= $lecturer["name"] ?>
                        </a>
                        <div class="secondary-content">
                            <a href="edit?id=<?= $lecturer["id"] ?>&name=<?= $lecturer["name"] ?>">Edit</a>
                        </div>
                    </h4>
                </div>
                <?php
                    foreach($lecturer['units'] as $unit){
                        ?>
                    <div class="collection-item">
                        <?= $unit["name"] ?>       
                    </div>
                <? } /* units */?>
            <? } /* lecturers */?>

        </div> 
        <?php if(isset($mainLecturer)){ ?>
            <div class="col s7">
                    <h3><?= $mainLecturer['name'] ?> </h3>
                    <div class="collection with-header">
                        <div class="collection-header"> Units </div>
                        <?php
                            foreach($mainLecturer['units'] as $unit){
                                ?>
                            <div class="collection-item">
                                <?= $unit["name"] ?> 
                                <div class="secondary-content">
                                    <?= $unit["year"] ?>
                                </div>      
                            </div>
                        <? } /* units */?>
                    </div>
            </div> 
        <? } ?>
    </div>
<?

include('../footer.php');