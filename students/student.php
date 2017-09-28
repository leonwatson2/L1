<div class="col s12 m6">
    <div class="card blue-grey darken-1">
        <div class="card-content white-text">
            <span class="card-title"><?= $mainStudent['name']?></span>
            <address><?= $mainStudent['address'] ?></address>
            <div><a href="tel:<?=$mainStudent['phone'] ?>"><?=$mainStudent['phone'] ?></a></div>
            <div id="enrolled-course" class="course">
                <?php
                if($mainStudent['course']){ 
                ?>
                Enrolled in 
                <strong>
                    <?= $mainStudent['course']['name'] ?>
                </strong>
                <?php
                }else {
                    ?>
                    Not enrolled.
                    <?
                }
                ?>
            </div>
        </div>
        <div class="card-action">
        <a href="#" id="edit-button" onclick="$$enroller.start()">Add/Edit Enrollment</a>
        <a href="#" id="save-button" onclick="$$enroller.save(<?= $mainStudent['id'] ?>)">Save</a>
        <a id="course-input"> 
            
            <?php foreach(get_courses($db) as $course){ ?>
                <div class="course">
                    <input checked type="radio" 
                            name="course" 
                            value="<?= $course['id'] ?>" 
                            id="<?= $course['id'] ?>"/> 

                    <label for="<?= $course['id'] ?>"><?= $course['name'] ?></label>
                </div>  
            <? } ?>
        </a>
        <?php
        if($mainStudent['course']){ 
        ?>
            <a class="btn" id="unenroll" onclick="$$enroller.unenroll(<?= $mainStudent['id'] ?>)">Unenroll</a>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<script>
var $$enroller;
document.addEventListener("DOMContentLoaded", function(event) {
    $("#course-input").hide();
    $("#save-button").hide();      
    $$enroller = $$enrollerFactory(<?= $mainStudent['id']?>, <?= $mainStudent['courseID'] ?>);
})

var $$enrollerFactory = function(studentId, courseId){
    let changed = false;
    $("input[name=course]").click((e)=>{
        changed = true;
        courseId = e.target.value;
    })
    function unenroll(id){
        $.post('./updateCourse.php', { courseId:null, studentId }, (response)=>{
            let res = JSON.parse(response);
            if(res.response){
                $("#enrolled-course").text("Not enrolled.");
                $("#unenroll").hide();
            }
        })
    }
    function getNewCourse(){
        $.post('./getCourse.php', { courseId }, (response)=>{
            let course = JSON.parse(response);
            if(course.name){
                $("#enrolled-course").html(`Enrolled in 
                                            <strong>
                                            ${course.name}
                                            </strong>`);

            }
        })
    }
    function start(studentID){
        $("#course-input").show();
        $("#edit-button").hide();
        $("#save-button").show();
        $("#unenroll").hide();
        
    }
    function save(studentID){

        $("#save-button").hide();            
        $("#course-input").hide();
        $("#edit-button").show();
        $("#unenroll").show();
        $.post('./updateCourse.php', {courseId, studentId} ,(response)=>{
            
            let res = JSON.parse(response);
            if(res.response)
                getNewCourse();
            
        })

    }
    return {
        start,
        save, 
        unenroll
    }
}
</script>