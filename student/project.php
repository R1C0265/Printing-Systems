<?php

/*TODO: Edit project Info
 * TODO: Add automated titles for the project documents.*/
/*TODO: Change states according to the state of project completion by student here
* TODO: EDIT PROJECT DATA*/

require("../config/main.php");

$active=1;
//load header content
$link=1;
include('header.php');

$myid = $_SESSION['userId'];
$pr = $db->query("SELECT * FROM project WHERE student = $myid")->fetchArray();

if($pr){
    //project there
    $prid = $pr['pr_id'];

    //lecturer
$lecturer  = $db ->query("select * from users where u_id = {$pr['lecture']}")->fetchArray();

    //Check for Concept note
    $projectId = $db->query("select pr_id from project where student = $myid")->fetchArray();
    $conceptNote = $db->query("SELECT type FROM pr_docs WHERE pr_id = $prid and type = 'concept note' ")->fetchArray();
    $umlDiagram = $db->query("select type from pr_docs where pr_id = $prid and type = 'uml document'")->fetchArray();
    $numberOfDocs = $db->query("select count(*) from  pr_docs where pr_id = $prid")->fetchArray();

    ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <div class="col-md-6 mb-4 stretch-card ">
                            <h3 class="font-weight-bold"><?php echo $pr['pr_name'] ?></h3>

                        </div>

                        <h6 class="font-weight-normal mb-0">Created on <span
                                class="text-primary"><?php echo dateStr( $pr['pr_stamp']) ?></span></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card tale-bg p-12">
                    <div class="card-body mt-auto">
                        <div class="                                                                                                                                                                                                                         stretch-card ">
                            <h3 class="font-weight-bold">About Project</h3>


                        </div>
                        <hr />
                        <p><?php echo $pr['pr_desc'] ?></p>
                        <p>Supervisor: <?php if($pr['lecture']==0) echo "No supervisor yet!"; else echo $lecturer['u_name'];?></p>
                        <hr />
                        <h3 >Project Documents</h3>


                        <div class="row">
                            <?php
                            $get = $db->query("SELECT * FROM pr_docs WHERE pr_id=$prid")->fetchAll();
                            foreach($get as $r){
                                if($r['type'] == "Final Project Zip"){
                                    ?>
                                    <div class="col-md-6 mb-4 stretch-card transparent">
                                        <div class="card card-tale" style="background-color: purple">
                                            <div class="card-body">
                                                <p class="mb-1"><?php echo $r['type'] ?></p>
                                                <?php
                                                if($pr['pr_state'] == 2){?>
                                                    <a hidden id="deleteOption" href="javascript: deleteDoc(<?php echo $r['pd_id'] ?>)"><i
                                                                class="icon-trash text-danger"></i></a>
                                                <?php } else {?>
                                                    <a  id="deleteOption" href="javascript: deleteDoc(<?php echo $r['pd_id'] ?>)"><i
                                                                class="icon-trash text-danger"></i></a>

                                                <?php }
                                                ?>
                                                <a href="../images/uploads/<?php echo $r['file'] ?>"><i
                                                            class="icon-download text-primary"></i></a>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                } else{
                            ?>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">

                                        <p class="mb-1"><?php echo $r['type'] ?></p>
                                        <?php
                                        if($pr['pr_state'] == 2){?>
                                            <a hidden id="deleteOption" href="javascript: deleteDoc(<?php echo $r['pd_id'] ?>)"><i
                                                        class="icon-trash text-danger"></i></a>
                                        <?php } else {?>
                                            <a  id="deleteOption" href="javascript: deleteDoc(<?php echo $r['pd_id'] ?>)"><i
                                                        class="icon-trash text-danger"></i></a>

                                        <?php }
                                        ?>

                                        <a href="../images/uploads/<?php echo $r['file'] ?>"><i
                                                class="icon-download text-primary"></i></a>

                                    </div>
                                </div>
                            </div>

                            <?php }
                            }?>
                        </div>
                    </div>
                </div>

            </div>
            <?php
            if($numberOfDocs['count(*)'] == '7' ){
                ?>
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <br /><br /><br /><br /><br />

                            <div class="text-center" style="width: 100%; height: 50vh">
                                <?php
                                if($pr['pr_state'] == '2'){?>
                                    <div id="retractSubmission">
                                        <form id="submitProject">
                                            <h3 id="retractNotification"   class="text-success"><i class="icon-circle-check mb-3"></i>PROJECT SUBMITTED</h3>
                                            <br>
                                            <button class="btn btn-danger" id="submitbtn" type="submit"  ><i class="icon-upload"></i><b>RETRACT SUBMISSION</b></button>
                                            <br>  <br>
                                            <p id="retractableDate" class = "text-gray">RETRACTABLE TILL 12/12/2nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn,,,,,,,,,,,,,,,,,,,,,, 2</p>
                                        </form>
                                    </div>

                                <?php
                                } else{ ?>
                                    <div id="notification">
                                        <form id="submitProject" >
                                            <h3   class="text-success"><i class="icon-circle-check mb-3"></i>PROJECT FULLY UPLOADED</h3>
                                            <br>
                                            <button id="submitbtn" type="submit" class="btn btn-success"><i class="icon-upload"></i><b>SUBMIT PROJECT</b></button>
                                        </form>

                                    </div>
                                <?php
                                }?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }else if($pr['lecture'] !== 0){
                ?>
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <br /><br /><br /><br /><br />

                            <a  data-toggle="modal" data-target="#addDoc" style="width: 100%; height: 50vh"
                                class="text-center btn btn-default"> <i class="icon-upload mb-3"></i><br />Upload
                                Document</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>


    <?php
}
else{
    ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Please Create a project first</h3>
                            <!--<h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <br /><br /><br /><br /><br />
                            <a data-toggle="modal" data-target="#exampleModal" style="width: 100%; height: 40vh"
                                class="text-center btn btn-default"> <i class="icon-plus mb-3"></i><br />Create
                                Project</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <?php
}

?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="pt-3" id="register" enctype="multipart/formdata">
                            <div class="form-group">
                                <label>Project Name</label>
                                <div class="input-group">
                                    <input type="text" required name="name" class="form-control form-control-lg "
                                        placeholder="Project Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Project Description</label>
                                <div class="input-group">
                                    <textarea type="text" required name="desc" class="form-control form-control-lg "
                                        placeholder="Project Description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Concept Note Document</label><br />
                                <input class="form-control form-control-lg " type="file" name="file" required
                                    accept=".docx,.doc,.pdf">

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btnSub" type="submit">Upload </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Document Model -->
        <div class="modal fade" id="addDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Project Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="pt-3" id="addDocument" enctype="multipart/formdata">

                            <input value="<?php echo $pr['pr_id'] ?>" name="id" hidden>

                            <h5 class="text-danger bold">All files should be uploaded in .pdf format.</h5>


                            <div class="form-group">
                                <label> Document</label><br />
                                <input class="form-control form-control-lg " type="file" name="file" required
                                    accept=".docx,.doc,.pdf">

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btnSub" type="submit">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <?php  include('footer.php'); ?>

        <script>
            function retractSubmission(){

            }

            function submitProject(){
            }
        </script>

        <script>
        function deleteDoc(id) {
            var formValues = {
                id: id
            };
            $.post("../model/deldoc.php", formValues, function(data) {
                        // Display the returned data in browser
                        console.log(data);
                        if (data == 1) {
                            alert("Document Deleted!");
                            setTimeout(function(e) {
                                location.reload();
                            }, 500);
                        } else {
                            alert("Error Encountered");
                        }
                    });
                }

                    $("#register").submit(function(e) {
                        e.preventDefault();
                        var pass = $("#password").val();

                        $.ajax({
                            url: "../model/proCreate.php",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                $("#btnSub").addClass("disabled");
                                $("#btnSub").html("Processing");

                            },
                            success: function(data) {
                                console.log(data);
                                if (data == 1) {

                                    setTimeout(function() {
                                        alert("Project Created!");
                                        window.location.reload();
                                    }, 500);
                                } else if (data == 3) {
                                    alert("Project already exists in system!");
                                } else {
                                    //user not found
                                    alert("Error Creating Account!");
                                }
                            },
                            error: function() {}
                        });


                    });

                    $("#addDocument").submit(function(e) {
                        e.preventDefault();


                        $.ajax({
                            url: "../model/addDoc.php",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                $("#btnSub").addClass("disabled");
                                $("#btnSub").html("Processing");

                            },
                            success: function(data) {
                                console.log(data);
                                if (data == 1) {

                                    setTimeout(function() {
                                        alert("Document Added!");
                                        window.location.reload();
                                    }, 500);
                                } else if (data == 3) {
                                    alert("All required files have already been uploaded successfully!");
                                } else {
                                    //user not found
                                    alert("Error uploading Document!");
                                }
                            },
                            error: function() {}
                        });


                    });

                     $("#submitProject").submit(function(e) {
                e.preventDefault();


                $.ajax({
                    url: "../model/proSubmit.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#submitbtn").addClass("disabled");
                        $("#submitbtn").html("Processing");
                    },
                    success: function(data) {

                        $("#retractNotification").remove();
                        $("#retractableDate").html("UNDOING UPLOAD");


                        console.log(data);
                        if (data == 1) {
                            window.location.reload();
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        } else if (data == 2) {
                            window.location.reload();
                        } else {
                            //user not found
                            alert("Error Submitting Project");
                        }
                    },
                    error: function() {}
                });


            });



        </script>