<?php

/*

 * TODO: Limit the number of projects a lecturer can select.
 * TODO: if Project is being supervised show the supervisor
*/

require("../config/main.php");

$active=2;
//load header content
$link=1;
include('header.php');
$id = $_GET['project'];

$pr = $db->query("SELECT * FROM project p INNER JOIN users u ON p.student=u.u_id WHERE pr_id = $id")->fetchArray();

?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-md-8  mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"><?php echo $pr['u_name'] ?></h3>
                        <!--<h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>-->
                    </div>
                    <div class="col-md-4  mb-4 mb-xl-0">
                        <?php 
                            if($pr['lecture']==0){
                                ?><a class="btn btn-primary" href="javascript: supervise(<?php echo $pr['pr_id']; ?>)"> Supervise Project</a><?php
                            }
                            else if($pr['pr_state'] == 2){?>
                                <a class="btn btn-success" href="javascript: complete(<?php echo $pr['pr_id']; ?>)"><i class="icon-circle-check"></i> Mark as Complete</a>
                                <?php
                            }

                            else if($pr['pr_state']==3){
                                ?>
                                <button class="btn btn-success" disabled><i class="icon-circle-check"></i> Complete</button>
                                <a class="btn btn-danger" href="javascript: complete(<?php echo $pr['pr_id']; ?>)"><i class="icon-circle-minus"></i> Revert Completion</a>
                          <?php  }
                        ?>
                        
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PROJECT INFORMATION</h4>
                        
                        <div class="table-responsive">
                            <H3><?php echo $pr['pr_name'] ?></H3>
                            <p> <?php echo $pr['pr_desc'] ?> </p> 

                            <p><small>Submitted on <?php echo dateStr($pr['pr_stamp']) ?> </small></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PROJECT DOCUMENTS</h4>

                        <div class="row">
                            <?php
                            $get = $db->query("SELECT * FROM pr_docs WHERE pr_id=$id")->fetchAll();
                            foreach($get as $r){
                                if(!($r['type'] == "Final Project Zip")){
                            ?>
                            <div class="col-md-12 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <p class="mb-1"><?php echo $r['type'] ?></p>
                                        
                                        <a href="../images/uploads/<?php echo $r['file'] ?>"><i
                                                class="icon-download text-primary"></i></a>

                                    </div>
                                </div>
                            </div>
                            <?php }else {?>
                                    <div class="col-md-12 mb-4 stretch-card transparent ">
                                        <div class="card card-tale" style="background-color: purple">
                                            <div class="card-body">
                                                <p class="mb-1"><?php echo $r['type'] ?></p>

                                                <a href="../images/uploads/<?php echo $r['file'] ?>"><i
                                                            class="icon-download text-primary"></i></a>

                                            </div>
                                        </div>
                                    </div>

                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>




        <?php  include('footer.php'); ?>

        <script>
        function supervise(id){
            var formValues = {
                id: id
            };
            $.post("../model/supervise.php", formValues, function(data) {
                // Display the returned data in browser
                console.log(data);
                if (data == 1) {
                    alert("Success");
                    setTimeout(function(e) {
                        location.reload();
                    }, 500);
                } else {
                    alert("Error Encountered");
                }
            });
        }
        function complete(id){
            var formValues = {
                id: id
            };
            $.post("../model/complete.php", formValues, function(data) {
                // Display the returned data in browser
                console.log(data);
                if (data == 1) {
                    alert("Project Is now Complete");
                    setTimeout(function(e) {
                        location.reload();
                    }, 500);
                } else if(data == 2) {
                    alert("PROJECT REVERTED");
                    location.reload();
                } else{
                    alert("Error Encountered");
                }
            });
        }
        </script>