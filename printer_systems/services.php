<?php

require("../config/main.php");

$active=2;
//load header content
$link=1;
include('header.php');

?>


<<!-- TODO #1: use input with  the value key word to bring the value for the selected inputs-->>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Services</h3>
                        <!--<h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>-->
                    </div>
                    <div class="col-12 col-xl-4">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Service</a>

                    </div>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Services</h4>
                        <a class="btn btn-danger" onclick="topdf()">Download pdf</a>
                        <div class="table-responsive">
                        <table class="table table-striped datatable" id="usertable">
                                <thead>
                                    <tr>
                                        <th>
                                            Service Title
                                        </th>
                                        <th>
                                            Service Description
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $db = new Database();
                                    $users = $db->query("SELECT * FROM services ")->fetchAll();
                                    foreach($users as $res){
                                        ?>
                                    <tr>

                                        <td>
                                            <?php echo $res['service_title'] ?>
                                        </td>
                                        <td>
                                            <?php echo $res['service_description'] ?>
                                        </td>
                                        <td>
                                            <a class="btn text-primary" href="javascript: editUser(<?php echo $res['services_id'] ?>)"><i
                                                    class=" icon-check"></i></a>

                                            <a class="btn text-danger" href="javascript: deleteUser(<?php echo $res['services_id'] ?>)"><i
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

        </div>

        <div>
            <h3 class="font-weight-bold">Add Services</h3>
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="addService">
                            <div class="form-group">
                                <label for="service_title">Name of Service</label>
                                <input type="text" class="form-control" name="serviceName">
                            </div>
                            <div class="form-group">
                                <label for="service_description">Service Description</label>
                                <textarea type="email" class="form-control" id="service_description" name="serviceDescription" placeholder = "Write a brief description on what the service does exactly"></textarea>
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">Add Service</button>

                        </form>
                        <hr />
                        <h4>Update Password</h4>
                        <form id="updPass">
                            <div class="form-group">
                                <label for="pass1">Old Password</label>
                                <input type="password" minlength="8" class="form-control" required name="old"
                                    placeholder="Old Password">
                            </div>
                            <div class="form-group">
                                <label for="pass1">New Password</label>
                                <input type="password" minlength="8" class="form-control" required name="pass"
                                    id="pass1" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="pass2">Confirm Password</label>
                                <input type="password" minlength="8" required class="form-control" id="pass2"
                                    placeholder="Confirm Password">
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update Info</button>
                        </form>
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
                        <h5 class="modal-title" id="exampleModalLabel">ADD LECTURER / COORDINATOR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="pt-3" id="register">
                            <div class="form-group">
                                <label>Lecturer Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="ti-user text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" required name="name"
                                        class="form-control form-control-lg border-left-0" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="ti-email text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="email" required name="email"
                                        class="form-control form-control-lg border-left-0" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <h4 class="text-google"><b>THE DEFAULT PASSWORD IS: 00000000 [8 zeros].</b></h4>
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btnSub" type="submit">Add Supervisor</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>ADD STUDENTS</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="pt-3" id="uplStudents">
                            <div class="form-group">
                                <label>Enter The Document Here</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                            <i class="ti-file text-primary"></i>
                                        </span>
                                    </div>
                                    <input required type="file"  name="file" accept=".csv"
                                           class="form-control form-control-lg border-left-0" >
                                </div>
                            </div>
                            <div class="form-group">
                                <h5 class="text-danger" hidden  id="csvError">The Uploaded file can only be in CSV format (*.CSV).</h5>
                            </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btnSub" type="submit" value="upload">Add Students</button>
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


            doc.save('All Users_<?php print date('d-m-Y'); ?>.pdf');
        }

        function deleteUser(id) {
            var formValues = {
                id:id
            };
            $.post("../model/delService.php", formValues, function(data) {
            // Display the returned data in browser
            console.log(data);
            if (data == 1) {
                alert("Service Deleted!");
                setTimeout(function(e) {
                    location.reload();
                }, 500);
            } else {
                alert("Error Encountered");
            }


        });

        }
        </script>
        <script>
        $("#register").submit(function(e) {
            e.preventDefault();
            var pass = $("#password").val();

            $.ajax({
                url: "../model/addUser.php",
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
                            alert("Account Created!");
                            window.location.href = "users.php";
                        }, 500);
                    } else if (data == 3) {
                        alert("User already exists in system!");
                    } else {
                        //user not found
                        alert("Error Creating Account!");
                    }
                },
                error: function() {}
            });


        });

        $("#addService").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "../model/addService.php",
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
                            alert("Information Updated!");
                            window.location.reload();
                        }, 500);
                    } else if (data == 3) {
                        alert("Email already exists in system!");
                    } else {
                        //user not found
                        alert("Error updating Information!");
                    }
                },
                error: function() {}
            });

        });


        $("#uplStudents").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "../model/uplCSV.php",
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
                            alert("Students Added to the system successfully");
                            window.location.reload();
                        }, 500);
                    } else if (data == 2) {
                        document.getElementById("csvError").removeAttribute("hidden")
                    } else if (data ==3) {
                        //user not found
                        alert("Error updating Information!");
                        window.location.reload();
                    } else{
                        alert("Error")
                    }
                },
                error: function() {}
            });

        });
        </script>


    </div>