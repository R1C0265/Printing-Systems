<?php

require("../config/main.php");

$active=1;
//load header content
$link=1;
include('header.php');

$myid = $_SESSION['userId'];
///// Dash Info //////

$customers = $db->query("SELECT COUNT(*) as num FROM users WHERE u_type = 3")->fetchArray();
$services = $db->query("SELECT COUNT(*) as num FROM services")->fetchArray();
$st = $db->query("SELECT COUNT(*) as num FROM users u INNER JOIN project p ON p.student=u.u_id WHERE p.lecture=$myid")->fetchArray();

?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome <?php echo $_SESSION['userName'] ?></h3>
                        <!--<h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>-->
                    </div>
                    <div class="col-12 col-xl-4">
                        <!--<div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="../images/dashboard/people.svg" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <!--<div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Bangalore</h4>
                                    <h6 class="font-weight-normal">India</h6>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                        <a style="text-decoration: none; color: #f2f2f2" href="customers.php">
                            <div class="card-body">
                                <p class="mb-4">Customers</p>
                                <p class="fs-30 mb-2"><?php echo $customers['num'] ?></p>
                                
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue card-tale">
                        <a style="text-decoration: none; color: #f2f2f2" href="services.php">
                            <div class="card-body">
                                <p class="mb-4">Services</p>
                                <p class="fs-30 mb-2"><?php echo $services['num'] ?></p>
                                
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


<?php  include('footer.php'); ?>