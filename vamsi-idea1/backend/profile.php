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

            <div id="layoutSidenav_content">
                <main>
                    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-fluid">
                            <div class="page-header-content">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="user"></i></div>
                                    <span>Your Profile</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($_COOKIE['_uid_'])) {
                            $user_id = base64_decode($_COOKIE['_uid_']);
                        } else if(isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                        } else {
                            $user_id = -1;
                        }
                        $sql = "SELECT * FROM users WHERE user_id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':id' => $user_id
                        ]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        $user_id = $user['user_id'];
                        $user_name = $user['user_name'];
                        $user_email = $user['user_email'];
                        $user_photo = $user['user_photo'];
                    ?>

                    <?php 
                        if(isset($_POST['submit'])) {
                            $user_name = $_POST['user-name'];
                            $user_email = $_POST['user-email'];
                            $user_photo = $_FILES['user-photo']['name'];
                            $user_photo_tmp = $_FILES['user-photo']['tmp_name'];
                            move_uploaded_file("{$user_photo_tmp}", "./assets/img/{$user_photo}");
                            if(empty($user_photo)) {
                                $sql = "SELECT * FROM users WHERE user_id = :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':id' => $user_id
                                ]);
                                $u = $stmt->fetch(PDO::FETCH_ASSOC);
                                $user_photo = $u['user_photo'];
                            }
                            $sql = "UPDATE users SET user_name = :name, user_email = :email, user_photo = :photo WHERE user_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':name' => $user_name,
                                ':email' => $user_email,
                                ':photo' => $user_photo,
                                ':id' => $user_id
                            ]);
                            header("Location: profile.php");
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Profile</div>
                            <div class="card-body">
                                <form action="profile.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="user-name">User Name:</label>
                                        <input name="user-name" value="<?php echo $user_name; ?>" class="form-control" id="user-name" type="text" placeholder="User Name..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="user-email">User Email:</label>
                                        <input name="user-email" value="<?php echo $user_email; ?>" class="form-control" id="user-email" type="email" placeholder="User Email..." />
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                        <label for="post-title">Choose photo:</label>
                                        <input name="user-photo" class="form-control" id="post-title" type="file" />
                                        <img src="./assets/img/<?php echo $user_photo; ?>" width="50" height="50" />
                                    </div>
                                    </div>
                                    <button name="submit" class="btn btn-primary mr-2 my-1" type="submit">Update now!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                </main>

<?php require_once('./includes/footer.php'); ?>