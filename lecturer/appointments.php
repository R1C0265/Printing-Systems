<?php

require("../config/main.php");

$active=2;
//load header content
$link=1;
include('header.php');

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
                    <div class="col-12 col-xl-4">


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Appointments</h4>
                        <a class="btn btn-danger" onclick="topdf()">Download pdf</a>
                        <div class="table-responsive">
                            <table class="table table-striped datatable" id="usertable">
                                <thead>
                                    <tr>
                                        <th>
                                            Purpose
                                        </th>
                                        <th>
                                            Student
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            State
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $get = $db->query("SELECT * FROM appointment a INNER JOIN users u ON u.u_id=a.student WHERE a.lecture = $myid ")->fetchAll();
                                    foreach($get as $ap){
                                        ?>
                                    <tr>

                                        <td>
                                            <?php echo $ap['ap_title'] ?>
                                        </td>
                                        <td>
                                            <?php echo $ap['u_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo dateStr($ap['date_']) ?>
                                        </td>
                                        <td>
                                            <?php
                                        if($ap['state']==0){
                                            echo "Not reviewed";
                                        }else if(($ap['state']==1)){
                                            echo "Accepted";
                                        }else if($ap['state']==3){
                                            echo "Rescheduled";
                                        }
                                        else echo "Declined";
                                        ?>
                                        </td>
                                        <td>
                                            <a href="javascript: reschedule(<?php echo $ap['ap_id'] ?>)"
                                                data-toggle="tooltip" data-placement="top" title="Reschedule"> <i
                                                    class="ti-reload"></i></a>
                                            &nbsp;&nbsp;<a class="text-danger"
                                                href="javascript: decline(<?php echo $ap['ap_id'] ?>)"
                                                data-toggle="tooltip" data-placement="top" title="Decline"><i
                                                    class="ti-na"></i></a>
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

        </div>

        <!-- Modal -->
        <div class="modal fade" id="apModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form class="pt-3" id="reschedule" enctype="multipart/formdata">
                            <div class="form-group">

                                <div class="input-group">
                                    <input type="text" required name="apid" id="apid"
                                        class="form-control form-control-lg " placeholder="Purpose" hidden>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Reschedule Date</label>
                                <div class="input-group">
                                    <input type="datetime-local" required name="date_"
                                        class="form-control form-control-lg " placeholder="Project Description"></input>
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

        function reschedule(id) {

            $("#apModal").modal("show");
            $("#apid").val(id);

        }
        $("#reschedule").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "../model/reschedule.php",
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
                            alert("Appointment Rescheduled!");
                            window.location.reload();
                        }, 500);
                    } else {
                        //user not found
                        alert("Error Rescheduling!");
                    }
                },
                error: function() {}
            });

        });

        function decline(id) {
            var formValues = {
                id: id
            };
            $.post("../model/decline.php", formValues, function(data) {
                // Display the returned data in browser
                console.log(data);
                if (data == 1) {
                    alert("Appointment Declined!");
                    setTimeout(function(e) {
                        location.reload();
                    }, 500);
                } else {
                    alert("Error Encountered");
                }
            });
        }
        </script>