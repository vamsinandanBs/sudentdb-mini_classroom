<?php require_once("./includes/db.php"); ?>
<?php require_once("./includes/header.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>SIGN UP || Admin Panel</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
      
        <script src="js/feather.min.js"></script>
    </head>
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
                            $usn = trim($_POST['susn']);
                            $subone = trim($_POST['sub-one']);
                            $subtwo = trim($_POST['sub-two']);
                            $subthree = trim($_POST['sub-three']);
                            $subfour = trim($_POST['sub-four']);
                            $subfive = trim($_POST['sub-five']);
                            $subsix = trim($_POST['sub-six']);
                            $labone = trim($_POST['lab-one']);
                            $labtwo = trim($_POST['lab-two']);
                            $exone = trim($_POST['ex-one']);
                            if($subone < 0 AND $subone > 100   ) {
                                $error = "enter the usn correctly";
                            } else {
                                $sql3 = "INSERT INTO studentmarks (stdusn, sub1, sub2, sub3, sub4, sub5, sub6,  lab1, lab2, ext1) VALUES (:usn, :sone, :stwo, :sthree, :sfour, :sfive,  :ssix, :lone, :ltwo, :eone)";
                                $stmt = $pdo->prepare($sql3);
                                $stmt->execute([
                                    ':usn' => $usn,
                                    ':sone' => $subone,
                                    ':stwo' => $subtwo,
                                    ':sthree' => $subthree,
                                    ':sfour' => $subfour,
                                    ':sfive' => $subfive,
                                    ':ssix' => $subsix,
                                    ':lone' => $labone,
                                    ':ltwo' => $labtwo,
                                    ':eone' => $exone
                                ]);
                                $success = true;
                            }

                        }
                    ?>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Enter Your Marks</h3></div>
                                    <div class="card-body">
                                    
                                        <form action="studentmarks.php" method="POST">
                                            <?php 
                                                if(isset($error)) {
                                                    echo "<p class='alert alert-danger'>{$error}</p>";
                                                }else if(isset($success)){
                                                    echo "<p class='alert alert-success'>
                                                        marks added successfully.<a href = 'studentmarks.php'> U Can Enter marks </a>
                                                    </p>";

                                                }
                                            ?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputUSN">enter your usn</label>
                                                        <input name="susn" class="form-control py-4" id="inputUSN" type="text" placeholder="enter usn" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSUBONE">subject 1</label>
                                                        <input name="sub-one" class="form-control py-4" id="inputSUBONE" type="number" placeholder="Enter subject 1 marks" required="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputSUBTWO">subject 2</label>
                                                         <input name="sub-two" class="form-control py-4" id="inputSUBTWO" type="number"  placeholder="Enter stuject 2 marks" required="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSUBTHREE">subject 3</label>
                                                        <input name="sub-three" class="form-control py-4" id="inputSUBTHREE" type="number" placeholder="Enter subject 3 marks" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSUBFOUR">subject 4</label>
                                                        <input name="sub-four" class="form-control py-4" id="inputSUBFOUR" type="number" placeholder="Enter subject 4 marks" required="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSUBFIVE">subject 5</label>
                                                        <input name="sub-five" class="form-control py-4" id="inputSUBFIVE" type="number" placeholder="Enter subject 5 marks" required="true" />
                                                    </div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSUBSIX">subject 6</label>
                                                        <input name="sub-six" class="form-control py-4" id="inputSUBSIX" type="number" placeholder="Enter subject 6 marks" required="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLABONE">lab 1</label>
                                                        <input name="lab-one" class="form-control py-4" id="inputLABONE" type="number" placeholder="Enter lab 1 marks" required="true" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLABTWO">lab 2</label>
                                                        <input name="lab-two" class="form-control py-4" id="inputLABTWO" type="number" placeholder="Enter lab 2 marks" required="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEXONE">extra sub 1</label>
                                                        <input name="ex-one" class="form-control py-4" id="inputEXONE" type="number" placeholder="Enter additional  marks" required="true" />
                                                    </div>
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
                                            <a href="stbasicd.php"><-- To Enter Basic Details</a>
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
