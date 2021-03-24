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
                                    <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                                    <span>Create New Category</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($_POST['button'])) {
                            $category_name = trim($_POST['category-name']);
                            $category_status = $_POST['category-status'];
                            if(isset($_COOKIE['_uid_'])) {
                                $user_id = base64_decode($_COOKIE['_uid_']);
                                $sql = "SELECT * FROM users WHERE user_id = :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([':id'=>$user_id]);
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                $user_name = $user['user_name'];
                            } else if($_SESSION['user_name']) {
                                $user_name = $_SESSION['user_name'];
                            }
                            // category_name, category_status, created_on, created_by
                            $sql = "INSERT INTO categories (category_name, category_status, created_on, created_by) VALUES (:cat_name, :cat_status, :created_on, :created_by)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':cat_name' => $category_name,
                                ':cat_status' => $category_status,
                                ':created_on' => date("d-m-Y H:i:s"),
                                ':created_by' => $user_name
                            ]);
                            header("Location: categories.php");
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Create New Category</div>
                            <div class="card-body">
                                <form action="new-category.php" method="POST">
                                    <div class="form-group">
                                        <label for="post-title">Category Name:</label>
                                        <input name="category-name" class="form-control" id="post-title" type="text" placeholder="Category Name..." required="true" />
                                    </div>
                                    <div class="form-group">
                                        <label for="post-status">Status:</label>
                                        <select name="category-status" class="form-control" id="post-status">
                                            <option value="Published">Published</option>
                                            <option value="Draft">Draft</option>
                                        </select>
                                    </div>
                                    <button name="button" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                </main>

 <?php require_once('./includes/footer.php'); ?>