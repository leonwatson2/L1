<div class="col s5 collection with-header">
    <?php
    foreach($courses as $course){
        ?>
        <div class="collection-header">
            <h4>
                <a href="?id=<?=$course["id"] ?>">
                    <?= $course["name"] ?>
                </a>
            </h4>
        </div>
        <?php
            foreach($course['units'] as $unit){
                ?>
            <div class="collection-item">
                <?= $unit["name"] ?>       
            </div>
        <? } /* units */?>
    <? } /* courses */?>

</div> 