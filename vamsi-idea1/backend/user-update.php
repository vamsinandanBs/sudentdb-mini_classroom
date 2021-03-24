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
                if(isset($_POST['edit-user'])) {
                    $user_id = $_POST['user-id'];
                    $url = "http://localhost:8080/vamsi-idea1/backend/user-update.php?user_id=".$user_id;
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
                                    <span>Updating User</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($_POST['update'])) {
                            $user_name = trim($_POST['user-name']);
                            $user_nickname = trim($_POST['user-nickname']);
                            // nickname exist
                            $sql1 = "SELECT * FROM users WHERE user_nickname = :nickname";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute([':nickname' => $user_nickname]);
                            $nickname_count = $stmt1->rowCount();
                            if($nickname_count >= 2) {
                                $err_nickname = "Nickname already exist!";
                            }
                            $user_email = trim($_POST['user-email']);
                            // email exist
                            $sql2 = "SELECT * FROM users WHERE user_email = :email";
                            $stmt2 = $pdo->prepare($sql2);
                            $stmt2->execute([':email'=>$user_email]);
                            $email_count = $stmt2->rowCount();
                            if($email_count >= 2) {
                                $err_email = "Email already exist!";
                            }
                            if(!isset($err_nickname) || !isset($err_email)) { 
                                $user_role = $_POST['user-role'];
                                $user_photo = $_FILES['user-photo']['name'];
                                $user_photo_tmp = $_FILES['user-photo']['tmp_name'];
                                move_uploaded_file("{$user_photo_tmp}", "./assets/img/{$user_photo}");
                                
                                if(empty($user_photo)) {
                                    $sql1 = "SELECT * FROM users WHERE user_id = :id";
                                    $stmt1 = $pdo->prepare($sql1);
                                    $stmt1->execute([':id'=>$_GET['user_id']]);
                                    $user = $stmt1->fetch(PDO::FETCH_ASSOC);
                                    $user_photo = $user['user_photo'];
                                }
                                $sql = "UPDATE users SET user_name = :name, user_nickname = :nickname, user_email = :email, user_photo = :photo, user_role = :role WHERE user_id = :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':name' => $user_name,
                                    ':nickname' => $user_nickname,
                                    ':email' => $user_email,
                                    ':photo' => $user_photo,
                                    ':role' => $user_role,
                                    ':id' => $_GET['user_id']
                                ]);
                                header("Location: users.php");
                            }
                            
                        }
                    ?>

                    <?php 
                        if(isset($_GET['user_id'])) {
                            $user_id = $_GET['user_id'];
                            $sql = "SELECT * FROM users WHERE user_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([':id'=>$user_id]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            $u_id = $user['user_id'];
                            $user_name = $user['user_name'];
                            $user_nickname = $user['user_nickname'];
                            $user_email = $user['user_email'];
                            $user_photo = $user['user_photo'];
                            $user_role = $user['user_role'];
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Edit User</div>
                            <div class="card-body">
                                <form action="user-update.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST" enctype="multipart/form-data">
                                    <?php 
                                        if(isset($err_email)) {
                                            echo "<p class='alert alert-danger'>{$err_email}</p>";
                                        } else if(isset($err_nickname)) {
                                            echo "<p class='alert alert-danger'>{$err_nickname}</p>";
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="user-name">User Name:</label>
                                        <input value="<?php echo $user_name; ?>" name="user-name" class="form-control" id="user-name" type="text" placeholder="User Name..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="user-nickname">User Nick Name:</label>
                                        <input value="<?php echo $user_nickname; ?>" name="user-nickname" class="form-control" id="user-nickname" type="text" placeholder="Enter nickname..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="user-email">User Email:</label>
                                        <input value="<?php echo $user_email; ?>" name="user-email" class="form-control" id="user-email" type="email" placeholder="User Email..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="user-role">Role:</label>
                                        <select name="user-role" class="form-control" id="user-role">
                                            <option value="admin" <?php echo $user_role=="admin"?"selected":""; ?>>Admin</option>
                                            <option value="subscriber" <?php echo $user_role!="admin"?"selected":""; ?>>Subscriber</option>
                                        </select>
                                        <div class="form-group">
                                        <label for="post-title">Choose photo:</label>
                                        <input name="user-photo" class="form-control" id="post-title" type="file" />
                                        <img src="./assets/img/<?php echo $user_photo; ?>" height="50" width="50" />
                                    </div>
                                    </div>
                                    <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Update now!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                </main>

 <?php require_once('./includes/footer.php'); ?>