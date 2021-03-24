<?php require_once('./includes/header.php'); ?>
<?php require_once("./includes/db.php"); ?>
<?php $current_page = "download notes"; ?>
    <body class="nav-fixed">
        
        

        <!--Side Nav-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php 
                    $curr_page = basename(__FILE__);
                    
                ?>
            </div>


            <div id="layoutSidenav_content">
                <main>
                    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-fluid">
                            <div class="page-header-content">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                                    <span>Notes , textbooks</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <!--Table-->
                    <div class="container-fluid mt-n10">

                    <!--Card Primary-->
           
                    <!--Card Primary-->

                        <div class="card mb-4">
                            <div class="card-header">notes:</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>file</th>
                                                <th>DOWNLOAD</th>
                                                <th>SUBJECT</th>
                                                <th>Posted On</th>
                                                <th>Author</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM upload ";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($upload = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // post_id, post_title, post_views, post_image, post_date, post_author, post_category_id, category_name
                                                    $post_id = $upload['u_id'];
                                                   
                                                    $post_views = $upload['typeoff_ile'];
                                                    $post_image = $upload['file'];
                                                    $post_date = $upload['date'];
                                                    $post_author = $upload['upload_author']; ?>
                                                        <tr>
                                                            <td><?php echo $post_id; ?></td>
                                                            <td><?php echo $post_image; ?></td>
                                   
                                                            <td> <embed src="<?php echo $post_image; ?>" type="application/pdf"   height="300px" width="100%" class="responsive"><a href="./img/<?php echo $post_image; ?>">download</a></td>
                                                            <td><?php echo $post_views; ?></td>
                                                            <td><?php echo $post_date; ?></td>
                                                            <td><?php echo $post_author; ?></td>
                                                           
                                                        </tr> 
                                                <?php }
                                            ?>
                                                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->

                </main>


<?php require_once('./includes/footer.php'); ?>