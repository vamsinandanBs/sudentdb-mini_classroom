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
                                    <span>Student Marks greater than 40%</span>
                                </h1>
                                <a href="new-page.html" title="Add New Page" class="btn btn-white">
                                    <div class="page-header-icon"><i data-feather="plus"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--Table-->
                    <div class="container-fluid mt-n10">

                        <div class="card mb-4">
                            <div class="card-header">Student Marks</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>sno</th>
                                                <th>USN</th>
                                                <th>sub1</th>
                                                <th>sub2</th>
                                                <th>Sub3</th>
                                                <th>sub4</th>
                                                <th>sub5</th>
                                                <th>sub6</th>
                                                <th>lab1</th>
                                                <th>lab2</th>
                                                <th>extra sub</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>sno</th>
                                                <th>USN</th>
                                                <th>sub1</th>
                                                <th>sub2</th>
                                                <th>Sub3</th>
                                                <th>sub4</th>
                                                <th>sub5</th>
                                                <th>sub6</th>
                                                <th>lab1</th>
                                                <th>lab2</th>
                                                <th>extra sub</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                                if(isset($_POST['delete-marks'])) {
                                                    $mk_id = $_POST['mk-id'];
                                                    $sql = "DELETE FROM studentmarks WHERE mk_id = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $mk_id
                                                    ]);
                                                    header("Location: pages.php");
                                                }
                                            ?>

                                            <?php 
                                                $sql = "SELECT * FROM studentmarks where  (sub1+sub2+sub3+sub4+sub5+sub6+lab1+lab2+ext1) > 359";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($studentmarks = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // post_id, post_category_id, post_title, post_details, 
                                                    // post_image, post_date, post_status, post_author, post_views, 
                                                    // post_comment_count, post_tags
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
                                                    $e1 = $studentmarks['ext1']; ?>
                                                    <tr>

                                                        <td><?php echo $mk_id; ?></td>
                                                        <td><?php echo $usn; ?></td>
                                                        <td><?php echo $s1; ?></td>
                                                        <td><?php echo $s2; ?></td>
                                                        <td><?php echo $s3; ?></td>
                                                        <td><?php echo $s4; ?></td>
                                                        <td><?php echo $s5; ?></td>
                                                        <td><?php echo $s6; ?></td>
                                                        <td><?php echo $l1; ?></td>
                                                        <td><?php echo $l2; ?></td>
                                                        <td><?php echo $e1; ?></td>
                                                       
                                                        
                                                        <td>
                                                            <form action="editmarks.php" method="POST">
                                                                <input type="hidden" value="<?php echo $mk_id; ?>" name="mk_id" />
                                                                <button name="editmarks" type="submit" class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="pages.php" method="POST">
                                                                <input type="hidden" name="mk_id" value="<?php echo $mk_id; ?>" />
                                                                <button name="delete-post" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                            </form>
                                                        </td>
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