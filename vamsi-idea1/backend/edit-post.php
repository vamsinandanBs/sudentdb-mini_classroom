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
                if(isset($_POST['edit-post'])) {
                    $post_id = $_POST['post-id'];
                    $url = "http://localhost:8080/vamsi-idea1/backend/edit-post.php?post_id=".$post_id;
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
                                    <span>Try Updating Post</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($_GET['post_id'])) {
                            $post_id = $_GET['post_id'];
                            $sql = "SELECT * FROM posts WHERE post_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':id' => $post_id
                            ]);
                            $post = $stmt->fetch(PDO::FETCH_ASSOC);
                            $post_title = $post['post_title'];
                            $post_status = $post['post_status'];
                            $post_category_id = $post['post_category_id'];

                            $post_photo = $post['post_image'];
                            $post_detail = $post['post_detail'];
                            $post_tags = $post['post_tags'];
                        }
                    ?>

                    <?php 

                        if(isset($_POST['update'])) {
                            $post_title = trim($_POST['post-title']);
                            $post_status = $_POST['post-status'];
                            $post_category_id = $_POST['post-category'];
                            $post_photo = $_FILES['post-photo']['name'];
                            $post_photo_tmp = $_FILES['post-photo']['tmp_name'];
                            move_uploaded_file("{$post_photo_tmp}", "./../img/{$post_photo}");
                            if(empty($post_photo)) {
                                $sql2 = "SELECT * FROM posts WHERE post_id = :id";
                                $stmt2 = $pdo->prepare($sql2);
                                $stmt2->execute([':id'=>$_GET['post_id']]);
                                $post = $stmt2->fetch(PDO::FETCH_ASSOC);
                                $post_photo = $post['post_image'];
                            }
                            $post_detail = $_POST['post-detail'];
                            $post_tags = $_POST['post-tags'];
                            $sql = "UPDATE posts SET post_title = :title, post_status = :status, post_category_id = :cat_id, post_image = :image, post_detail = :detail, post_tags = :tags WHERE post_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':title' => $post_title,
                                ':status' => $post_status,
                                ':cat_id' => $post_category_id,
                                ':image' => $post_photo,
                                ':detail' => $post_detail,
                                ':tags' => $post_tags,
                                ':id' => $_GET['post_id']
                            ]);
                            header("Location: all-post.php");
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Update Post</div>
                            <div class="card-body">
                                <form action="edit-post.php?post_id=<?php echo $_GET['post_id'] ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="post-title">Post Title:</label>
                                        <input name="post-title" value="<?php echo $post_title; ?>" class="form-control" id="post-title" type="text" placeholder="Post title ..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="post-status">Post Status:</label>
                                        <select name="post-status" class="form-control" id="post-status">
                                            <option value="Published" <?php echo $post_status == "Published"?"selected":""; ?>>Published</option>
                                            <option value="Draft" <?php echo $post_status != "Published"?"selected":""; ?>>Draft</option>
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
                                                    <option value="<?php echo $cats['category_id']; ?>" <?php echo $cats['category_id']==$post_category_id?"selected":""; ?>> 
                                                        <?php echo $cats['category_name']; ?> 
                                                    </option>
                                               <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="post-title">Choose photo:</label>
                                        <input name="post-photo" class="form-control" id="post-title" type="file" />
                                        <img src="../img/<?php echo $post_photo; ?>" height="60" width="60" />
                                    </div>

                                    <div class="form-group">
                                        <label for="post-content">Post Details:</label>
                                        <textarea name="post-detail" class="form-control" placeholder="Type here..." id="post-content" rows="9"><?php echo $post_detail; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="post-tags">Post Tags:</label>
                                        <textarea name="post-tags" class="form-control" placeholder="Tags..." id="post-tags" rows="3"><?php echo $post_tags; ?></textarea>
                                    </div>
                                    <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->

                </main>

<?php require_once('./includes/footer.php'); ?>
