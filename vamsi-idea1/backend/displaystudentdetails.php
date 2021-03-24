<?php require_once("./includes/header.php"); ?>
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

            <div id="layoutSidenav_content">
                <main>
                    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-fluid">
                            <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="book-open"></i></div>
                                    <span>Student Details</span>
                                </h1>
                                <a href="new-page.php" title="Add New Page" class="btn btn-white">
                                    <div class="page-header-icon"><i data-feather="plus"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--Table-->
                    <div class="container-fluid mt-n10">

                        <div class="card mb-4">
                            <div class="card-header">Student Details</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>USN</th>
                                                <th>NAME</th>
                                                <th>CONTACT NO</th>
                                                <th>SEMISTER</th>
                                                <th>ADDRESS</th>
                                                <th>EMAIL</th>
                                                <th>College</th>
                                                <th>PU college</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php 
                                                $sql = "SELECT * FROM studentdetails";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($studentdetails = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // post_id, post_title, post_views, post_image, post_date, post_author, post_category_id, category_name
                                                    $usn =$studentdetails['usn'];
                                                    $suser_name = $studentdetails['suser_name'];
                                                    $phonenum = $studentdetails['phonenum'];
                                                    $currentsem = $studentdetails['currentsem'];
                                                    $address = $studentdetails['address'];
                                                    $user_email = $studentdetails['user_email'];
                                                    $collegename = $studentdetails['collegename'];
                                                    $pucollegename = $studentdetails['pucollegename'];
                                                     ?>
                                                        <tr>
                                                            <td><?php echo $usn; ?></td>
                                                            <td><?php echo $suser_name; ?></td>
                                                            <td><?php echo $phonenum; ?></td>
                                                            <td><?php echo $currentsem; ?></td>
                                                            <td><?php echo $address; ?></td>
                                                            <td><?php echo $user_email; ?></td>
                                                            <td><?php echo $collegename; ?></td>
                                                            <td><?php echo $pucollegename; ?></td>
                                                        </tr> 
                                                <?php }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </main>

<?php require_once("./includes/footer.php"); ?>