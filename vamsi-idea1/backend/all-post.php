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
                                    <div class="page-header-icon"><i data-feather="layout"></i></div>
                                    <span>All Posts</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">All Posts</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Details</th>
                                                <th>Tags</th>
                                                <th>Comments</th>
                                                <th>Views</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Details</th>
                                                <th>Tags</th>
                                                <th>Comments</th>
                                                <th>Views</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                                if(isset($_POST['delete-post'])) {
                                                    $post_id = $_POST['post-id'];
                                                    $sql = "DELETE FROM posts WHERE post_id = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $post_id
                                                    ]);
                                                    header("Location: all-post.php");
                                                }
                                            ?>

                                            <?php 
                                                $sql = "SELECT * FROM posts";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($posts = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // post_id, post_category_id, post_title, post_details, 
                                                    // post_image, post_date, post_status, post_author, post_views, 
                                                    // post_comment_count, post_tags
                                                    $post_id = $posts['post_id'];
                                                    $post_category_id = $posts['post_category_id'];
                                                    // category_name from categories table
                                                    $sql1 = "SELECT * FROM categories WHERE category_id = :id";
                                                    $stmt1 = $pdo->prepare($sql1);
                                                    $stmt1->execute([':id'=>$post_category_id]);
                                                    $cat = $stmt1->fetch(PDO::FETCH_ASSOC);
                                                    $category_title = $cat['category_name'];

                                                    $post_title = $posts['post_title'];
                                                    $post_details = substr($posts['post_detail'], 0, 10);
                                                    $post_image = $posts['post_image'];
                                                    $post_date = $posts['post_date'];
                                                    $post_status = $posts['post_status'];
                                                    $post_author = $posts['post_author'];
                                                    $post_views = $posts['post_views'];
                                                    $post_comment_count = $posts['post_comment_count'];
                                                    $post_tags = substr($posts['post_tags'], 0, 10); ?>
                                                    <tr>
                                                        <td><?php echo $post_id; ?></td>
                                                        <td>
                                                            <a href="../single.php?post_id=<?php echo $post_id ?>" target="_blank"><?php echo $post_title; ?></a>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-<?php echo $post_status=='Published'?'success':'warning'; ?>"><?php echo $post_status; ?></div>
                                                        </td>
                                                        <td><?php echo $category_title; ?></td>
                                                        <td><?php echo $post_author; ?></td>
                                                        <td>
                                                            <img src="./../img/<?php echo $post_image; ?>" width="50" height="50" />
                                                        </td>
                                                        <td><?php echo $post_date; ?></td>
                                                        <td><?php echo $post_details; ?></td>
                                                        <td><?php echo $post_tags; ?></td>
                                                        <td>
                                                            <a href="comments.php"><?php echo $post_comment_count; ?></a>
                                                        </td>
                                                        <td><?php echo $post_views; ?></td>
                                                        <td>
                                                            <form action="edit-post.php" method="POST">
                                                                <input type="hidden" value="<?php echo $post_id; ?>" name="post-id" />
                                                                <button name="edit-post" type="submit" class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="all-post.php" method="POST">
                                                                <input type="hidden" name="post-id" value="<?php echo $post_id; ?>" />
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
                    <!--End Table-->

                </main>

<?php require_once('./includes/footer.php'); ?>