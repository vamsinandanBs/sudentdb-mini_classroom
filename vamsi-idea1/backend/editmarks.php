<?php require_once('./includes/header.php'); ?>

    <body class="nav-fixed">
        <?php require_once('./includes/top-navbar.php'); ?>
        

        <!--Side Nav-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php 
                    $curr_page = basename(__FILE__);
                    require_once("./includes/left-sidebar.php");
                ?>
            </div>

            <?php 
                if(isset($_POST['editmarks'])) {
                    $mk_id = $_POST['mk_id'];
                    $url = "http://localhost:8080/vamsi-idea1/backend/editmarks.php?mk_id=".$mk_id;
                    header("Location: {$url}");
                }
            ?>


            <div id="layoutSidenav_content">
                <main>
                    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-fluid">
                            <div class="page-header-content">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                                    <span>Try Updating Marks</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($_GET['mk_id'])) {
                            $mk_id = $_GET['mk_id'];
                            $sql = "SELECT * FROM studentmarks WHERE mk_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':id' => $mk_id
                            ]);
                            $studentmarks= $stmt->fetch(PDO::FETCH_ASSOC);
                            $mk_id = $studentmarks['mk_id'];
                            $usn =$studentmarks['stdusn'];
                            $s1 = $studentmarks['sub1'];
                            $s2= $studentmarks['sub2'];
                            $s3 = $studentmarks['sub3'];
                            $s4 = $studentmarks['sub4'];
                            $s5 = $studentmarks['sub5'];
                            $s6 = $studentmarks['sub6'];
                            $l1 = $studentmarks['lab1'];
                            $l2 = $studentmarks['lab2'];
                            $e1 = $studentmarks['ext1'];
                        }
                    ?>

                    <?php 

                        if(isset($_POST['update'])) {
                            $mk_id = $studentmarks['mk_id'];
                            $s1 = $studentmarks['sub1'];
                            $s2= $studentmarks['sub2'];
                            $s3 = $studentmarks['sub3'];
                            $s4 = $studentmarks['sub4'];
                            $s5 = $studentmarks['sub5'];
                            $s6 = $studentmarks['sub6'];
                            $l1 = $studentmarks['lab1'];
                            $l2 = $studentmarks['lab2'];
                            $e1 = $studentmarks['ext1'];
                            $sql = "UPDATE studentmarks SET sub1 = :ss1, sub2 = :ss2,  sub3 = :ss3,  sub4 = :ss4,  sub5= :ss5,  sub6 = :ss6,  lab1 = :ll1,  lab2 = :ll2,  ext1 = :ee1, WHERE mk_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':ss1' => $s1,
                                ':ss2' => $s2,
                                ':ss3' => $s3,
                                ':ss4' => $s4,
                                ':ss5' => $s5,
                                ':ss6' => $s6,
                                ':ll1' => $l1,
                                ':ll2' => $l2,
                                ':ee1' => $e1
                                
                            ]);
                            header("Location: pages.php");
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Update marks</div>
                            <div class="card-body">
                                <form action="editmarks.php?mk_id=<?php echo $_GET['mk_id'] ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="sub1">sub1:</label>
                                        <input name="sub1" value="<?php echo $s1; ?>" class="form-control" id="sub1" type="number" placeholder="sub1 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="sub2">sub2:</label>
                                        <input name="sub2" value="<?php echo $s2; ?>" class="form-control" id="sub2" type="number" placeholder="sub2 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="sub3">sub3:</label>
                                        <input name="sub3" value="<?php echo $s3; ?>" class="form-control" id="sub3" type="number" placeholder="sub3 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="sub4">sub4:</label>
                                        <input name="sub4" value="<?php echo $s4; ?>" class="form-control" id="sub4" type="number" placeholder="sub4 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="sub5">sub5:</label>
                                        <input name="sub5" value="<?php echo $s5; ?>" class="form-control" id="sub5" type="number" placeholder="sub5 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="sub6">sub6:</label>
                                        <input name="sub6" value="<?php echo $s6; ?>" class="form-control" id="sub6" type="number" placeholder="sub6 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="lab1">lab1:</label>
                                        <input name="lab1" value="<?php echo $l1; ?>" class="form-control" id="lab1" type="number" placeholder="lab1 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="lab2">lab2:</label>
                                        <input name="lab2" value="<?php echo $l2; ?>" class="form-control" id="lab2" type="number" placeholder="lab2 marks..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="ext1">ext sub1:</label>
                                        <input name="ext2" value="<?php echo $e1; ?>" class="form-control" id="ext1" type="number" placeholder="extsub1 marks..." />
                                    </div>

                                    <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->

                </main>

<?php require_once('./includes/footer.php'); ?>