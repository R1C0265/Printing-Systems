<?php

require("../config/main.php");

$active=1;
//load header content
$link=1;
include('header.php');

//getpr
$myid = $_SESSION['userId'];

    ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Appointments</h3>
                            <!--<h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-body mt-auto">
                        <div class="table-responsive">
                            <table class="table table-striped datatable" id="usertable">
                                <thead>
                                    <tr>
                                        <th>
                                            Appointment Reason
                                        </th>
                                        <th>
                                            Lecturer
                                        </th>
                                        <th>
                                           Date
                                        </th>
                                        <th>
                                            State
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $users = $db->query("SELECT * FROM appointment a INNER JOIN users u ON a.lecture=u.u_id WHERE student = $myid ")->fetchAll();
                                    foreach($users as $res){
                                        ?>
                                    <tr>

                                        <td>
                                            <?php echo $res['ap_title'] ?>
                                        </td>
                                        <td>
                                            <?php echo $res['u_name'] ?>
                                        </td>
                                        <td>
                                            <?php
                                        if($res['state']==0){
                                            echo "Not reviewed";
                                        }else if(($res['state']==1)){
                                            echo "Accepted";
                                        }else if($res['state']==2){
                                            echo "Rescheduled";
                                        }
                                        else echo "Declined";
                                        ?>
                                        </td>
                                        <td>
                                            <?php echo dateS($res['u_stamp']) ?>
                                        </td>
                                        <td>
                                            <a class="btn text-danger" href="javascript: deleteAp(<?php echo $res['ap_id'] ?>)"><i
                                                    class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }


                                    ?>



                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
            </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <br /><br /><br /><br /><br />
                            <a data-toggle="modal" data-target="#exampleModal" style="width: 100%; height: 40vh"
                                class="text-center btn btn-default"> <i class="icon-plus mb-3"></i><br />Create
                                Appointment</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="pt-3" id="addap" enctype="multipart/formdata">
                            <div class="form-group">
                                <label>Appointment Purpose</label>
                                <div class="input-group">
                                    <input type="text" required name="purpose" class="form-control form-control-lg "
                                        placeholder="Purpose">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Appointment Date</label>
                                <div class="input-group">
                                    <input type="datetime-local" required name="date_" class="form-control form-control-lg "
                                        placeholder="Project Description"></input>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btnSub" type="submit">Save </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->


        <?php  include('footer.php'); ?>
        <script>
            function topdf() {
            var doc = new jsPDF();
            //doc.text(20, 20, "Hello!");
            //let finalY = doc.lastAutoTable.finalY; // The y position on the page
            doc.autoTable({
                html: '#usertable'
            });


            doc.save('Appointments_<?php print date('d-m-Y'); ?>.pdf');
        }
        function deleteAp(id) {
            var formValues = {
                id: id
            };
            $.post("../model/delap.php", formValues, function(data) {
                        // Display the returned data in browser
                        console.log(data);
                        if (data == 1) {
                            alert("Appointment Deleted!");
                            setTimeout(function(e) {
                                location.reload();
                            }, 500);
                        } else {
                            alert("Error Encountered");
                        }
                    });
                }

                    $("#addap").submit(function(e) {
                        e.preventDefault();
                        

                        $.ajax({
                            url: "../model/addap.php",
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
                                        alert("Appointment Submitted!");
                                        window.location.reload();
                                    }, 500);
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
                                    alert("Document already exists in system!");
                                } else {
                                    //user not found
                                    alert("Error uploading Document!");
                                }
                            },
                            error: function() {}
                        });


                    });
        </script>