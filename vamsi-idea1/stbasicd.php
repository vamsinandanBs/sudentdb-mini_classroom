<?php require_once("./includes/db.php"); ?>
<?php require_once("./includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
    
    <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                        <div class="container">
                            <a class="navbar-brand text-dark" href="index.php">Vamsi-Pramod</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><img src="./img/menu.png" style="height:20px;width:25px" /><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-5">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home </a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                </ul>
                                <?php 
                                    $curr_page = basename(__FILE__);
                                    require_once("./includes/registration.php");
                                ?>
                            </div>
                        </div>
                    </nav>
    
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>

                    <?php
                        if(isset($_POST['submit'])) {
                            $sfirst_name = trim($_POST['first-name']);
                            $slast_name = trim($_POST['last-name']);
                            $sfull_name = $sfirst_name . " " . $slast_name;

                            $susn = trim($_POST['usn']);
                            $sphone_num = trim($_POST['phone-num']);
                            $scurrent_sem = trim($_POST['current-sem']);
                            $saddress = trim($_POST['address']);
                            $semail = trim($_POST['email-add']);
                            $scollegename = trim($_POST['collegename']);
                            $spucollegename = trim($_POST['pucollegename']);
                            if($sfirst_name == $slast_name) {
                                $error = "first and last name are same";
                            } else {
                                $sql2 = "INSERT INTO studentdetails (suser_name, usn, phonenum, currentsem, address, user_email, collegename,  pucollegename) VALUES (:name, :cusn, :phone, :currentsemi, :stdaddress, :email,  :college, :pucollege)";
                                $stmt = $pdo->prepare($sql2);
                                $stmt->execute([
                                    ':name' => $sfull_name,
                                    ':cusn' => $susn,
                                    ':phone' => $sphone_num,
                                    ':currentsemi' => $scurrent_sem,
                                    ':stdaddress' => $saddress,
                                    ':email' => $semail,
                                    ':college' => $scollegename,
                                    ':pucollege' => $spucollegename 
                                ]);
                                $success = true;
                            }

                        }
                    ?>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Enter Your Basic Details</h3></div>
                                    <div class="card-body">
                                     
                                     
                                        <form action="stbasicd.php" method="POST">
                                            <?php 
                                                if(isset($error)) {
                                                    echo "<p class='alert alert-danger'>{$error}</p>";
                                                }else if(isset($success)){
                                                    echo "<p class='alert alert-success'>
                                                        detalis added successfully.<a href = 'studentmarks.php'> U Can Enter marks </a>
                                                    </p>";

                                                }
                                            ?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input name="first-name" class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input name="last-name" class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" required="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputUSN">USN</label>
                                                         <input name="usn" class="form-control py-4" id="inputUSN" type="text"  placeholder="Enter college usn" required="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputContactNum">Contact Number</label>
                                                        <input name="phone-num" class="form-control py-4" id="inputPhoneNum" type="tel" placeholder="Enter your phone number" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputCurrentSem">Current Semister</label>
                                                        <input name="current-sem" class="form-control py-4" id="inputCurrentSem" type="number" placeholder="Enter your sem" required="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputAddress">ADDRESS</label>
                                                        <input name="address" class="form-control py-4" id="inputAddress" type="text" placeholder="Enter Your Address" required="true" />
                                                    </div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label>
                                                        <input name="email-add" class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required="true" />
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputCollegeName">College Name</label>
                                                        <input name="collegename" class="form-control py-4" id="inputCollegeName" type="text" placeholder="Enter your college name" required="true" />
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPUCollegeName">PU College Name</label>
                                                        <input name="pucollegename" class="form-control py-4" id="inputPUCollegeName" type="text" placeholder="Enter pu college name" required="true" />
                                                    </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <button name="submit" class="btn btn-primary btn-block" type="submit">Submit Details</button>
                                            </div>
                                        </form>
                                    </div>
                                   
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <a href="index.php"><--home? Go back to home</a>
                                            <a href="studentmarks.php">--> click here to enter marks</a>
                                            <marquee><h3> <a href="studentmarks.php">click here to enter marks</a></h3></marquee>
                                        </div>

                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!--Script JS-->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
