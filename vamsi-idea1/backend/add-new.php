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
                                    <span>Try Creating New Post</span>
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
                        $user_name = $user['user_name'];
                    ?>

                    <?php 

                        if(isset($_POST['new-post'])) {
                            $post_title = trim($_POST['post-title']);
                            $post_status = $_POST['post-status'];
                            $post_category_id = $_POST['post-category'];
                            $post_photo = $_FILES['post-photo']['name'];
                            $post_photo_tmp = $_FILES['post-photo']['tmp_name'];
                            move_uploaded_file("{$post_photo_tmp}", "./../img/{$post_photo}");
                            $post_detail = $_POST['post-detail'];
                            $post_tags = $_POST['post-tags'];
                            $sql = "INSERT INTO posts (post_category_id, post_title, post_detail, post_image, post_date, post_status, post_author, post_views, post_comment_count, post_tags) VALUES (:id, :title, :detail, :image, :date, :status, :author, :views, :comment, :tags)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':id' => $post_category_id,
                                ':title' => $post_title,
                                ':detail' => $post_detail,
                                ':image' => $post_photo,
                                ':date' => date("M n, Y") . ' at ' . date("h:i A"),
                                ':status' => $post_status,
                                ':author' => $user_name,
                                ':views' => 0,
                                ':comment' => 0,
                                ':tags' => $post_tags
                            ]);
                            header("Location: all-post.php");
                        }
                    ?>

                    <!--Start Form-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Create New Post</div>
                            <div class="card-body">
                                <form action="add-new.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="post-title">Post Title:</label>
                                        <input name="post-title" class="form-control" id="post-title" type="text" placeholder="Post title ..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="post-status">Post Status:</label>
                                        <select name="post-status" class="form-control" id="post-status">
                                            <option value="Published">Published</option>
                                            <option value="Draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="select-category">Select Category:</label>
                                        <select name="post-category" class="form-control" id="select-category">
                                            <?php 
                                                $sql = "SELECT * FROM categories WHERE category_status = :status";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute([
                                                    ':status' => 'Published'
                                                ]);
                                                while($cats = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $cats['category_id']; ?>"> 
                                                        <?php echo $cats['category_name']; ?> 
                                                    </option>
                                               <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="post-title">Choose photo:</label>
                                        <input name="post-photo" class="form-control" id="post-title" type="file" />
                                    </div>

                                    <div class="form-group">
                                        <label for="post-content">Post Details:</label>
                                        <textarea name="post-detail" class="form-control" placeholder="Type here..." id="post-content" rows="9"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="post-tags">Post Tags:</label>
                                        <textarea name="post-tags" class="form-control" placeholder="Tags..." id="post-tags" rows="3"></textarea>
                                    </div>
                                    <button name="new-post" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Form-->

                </main>

<?php require_once('./includes/footer.php'); ?>

