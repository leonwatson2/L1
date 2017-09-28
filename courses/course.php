    <div class="col s7">
            <h3><?= $mainCourse['name'] ?> <div class="secondary-content">$<?= $mainCourse['fee'] ?></div>   </h3>
            <div class="collection with-header">
                <div class="collection-header"> Units </div>
                <?php
                    foreach($mainCourse['units'] as $unit){
                        ?>
                    <div class="collection-item">
                        <?= $unit["name"] ?> 
                        <div class="secondary-content">
                            <?= $unit["year"] ?>
                        </div>      
                    </div>
                <? } /* units */?>
            </div>
            <div class="collection with-header">
                <div class="collection-header"> Enrolled Students </div>
                <?php
                    foreach(get_students_enrolled_in($mainCourse['id'], $db) as $unit){
                        ?>
                    <div class="collection-item">
                        <?= $unit["name"] ?> 
                        <div class="secondary-content">
                            <?= $unit["email"] ?>
                        </div>      
                    </div>
                <? } /* units */?>
            </div>
    </div> 