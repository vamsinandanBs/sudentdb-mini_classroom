<?php require_once('./includes/header.php'); ?>
<?php $current_page = "upload notes"; ?>
<?php require_once("./includes/db.php"); ?>
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
                                    <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                                    <span>SHARE THE NOTES AND DOCUMENTS HERE!!!</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php
                        if(isset($_POST['create'])) {
                            $user_name = trim($_POST['user-name']);
                            $user_nickname = trim($_POST['nick-name']);
                          
                               
                                $user_photo = $_FILES['user-photo']['name'];
                                $user_photo_temp = $_FILES['user-photo']['tmp_name'];
                                move_uploaded_file("{$user_photo}", "./assests/img/{$user_photo_temp}");


                                $sql = "INSERT INTO upload (file,typeoff_ile,date, upload_author) VALUES (:photo,:nickname,:date,:username)";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':photo' => $user_photo,
                                    ':nickname' => $user_nickname,
                                    ':date' => date("d-m-Y H:i:s"),
                                    ':username' => $user_name,
                                    
                                    
                                ]);
                                header("Location: upload.php");
                         
                            
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">share notes and Documents here</div>
                            <div class="card-body">
                                <form action="notes.php" method="POST" enctype="multipart/form-data">
                                    
                                    <div class="form-group">
                                        <label for="user-name">author Name:</label>
                                        <input name="user-name" class="form-control" id="user-name" type="text" placeholder="User Name..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="nickname">SUBJECT:</label>
                                        <input name="nick-name" class="form-control" id="nickname" type="text" placeholder="DOCUMENT releated which subject..." />
                                    </div>
                                 
                                   
                                    <div class="form-group">
                                       
                                        <div class="form-group">
                                        <label for="user-photo">Choose file:</label>
                                        <input name="user-photo" class="form-control" id="user-photo" type="file" />
                                    </div>
                                    </div>
                                    <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Add now!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                </main>

<?php require_once('./includes/footer.php'); ?>