<?php 
    include('../dbconnect.php');
    $title = "Students";
    include('../header.php');
    $id = null;
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $mainStudent = get_student($id, $db);
    }
    $students = get_students($db);
    ?>

    <h2>Students</h2>

    <div class="row">

        <div class="col s5 collection with-header">
            <input type="text" placeholder="search" onchange="updateStudents(this)"/>
            <div class="list">
                <?php
                foreach($students as $student){
                    ?>
                    <div class="collection-item">
                        <h4>
                            <a href="?id=<?=$student["id"] ?>">
                                <?= $student["name"] ?>
                            </a>
                        </h4>
                    </div>
                <? } /* students */?>
            </div>
        </div> 
        <?php if(isset($mainStudent)){ ?>
            <? include('student.php'); ?>
        <? } ?>
    <script>
        var students = JSON.parse(`<?= json_encode($students) ?>`)
        console.log(students);

        function updateStudents({value}){
            const regex = new RegExp(value, 'gi');
            const filtered = students.filter(({name})=>{
                return name.match(regex)
            });
            const html = filtered.map((student)=>{ 
                return listItemHtml(student, value) 
                } )
            $('.list').html(html);

        }
        function listItemHtml(student, search){
            const regex = new RegExp(search, 'gi');            
            const name = student.name.replace(regex, `<span class="teal white-text">${search}</span>`)
            console.log(name)
            return `<div class="collection-item">
                        <h4>
                            <a href="?id=${student.id}">
                                ${name} 
                            </a>
                        </h4>
                    </div>`;
        }
        
    </script>
    </div>
<?

include('../footer.php');