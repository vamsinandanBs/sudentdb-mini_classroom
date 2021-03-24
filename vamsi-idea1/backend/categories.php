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
                            <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="chevrons-up"></i></div>
                                    <span>Categories</span>
                                </h1>
                                <a href="new-category.php" title="Add new category" class="btn btn-white">
                                    <div class="page-header-icon"><i data-feather="plus"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--Table-->
                    <div class="container-fluid mt-n10">

                        <div class="card mb-4">
                            <div class="card-header">All Categories</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Total Posts</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM categories";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($categories = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // category_id, category_name, category_total_posts, category_status, created_by
                                                    $category_id = $categories['category_id'];
                                                    $category_name = $categories['category_name'];
                                                    $category_total_posts = $categories['category_total_posts'];
                                                    $category_status = $categories['category_status'];
                                                    $created_by = $categories['created_by']; ?>
                                                    <tr>
                                                        <td><?php echo $category_id; ?></td>
                                                        <td>
                                                            <?php 
                                                                if($category_total_posts == 0) { ?>
                                                                    <?php echo $category_name; ?>
                                                               <?php } else { ?>
                                                                    <a href="../categories.php?category_id=<?php echo $category_id; ?>&category_name=<?php echo $category_name; ?>" target="_blank">
                                                                        <?php echo $category_name; ?>
                                                                    </a>
                                                              <?php }
                                                            ?>
                                                            
                                                        </td>
                                                        <td><?php echo $category_total_posts; ?></td>
                                                        <td><?php echo $created_by; ?></td>
                                                        <td>
                                                            <?php 
                                                                if($category_status == 'Published') { ?>
                                                                    <div class="badge badge-success"><?php echo $category_status; ?></div>
                                                               <?php } else { ?>
                                                                    <div class="badge badge-warning"><?php echo $category_status; ?></div>
                                                               <?php }
                                                            ?>
                                                            
                                                        </td>
                                                        <td>
                                                            <form action="edit-category.php" method="POST">
                                                                <input type="hidden" name="edit-id" value="<?php echo $category_id ?>" />
                                                                <button name="edit" type="submit" class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if (isset($_POST['delete-category'])) {
                                                                    $sql = "DELETE FROM categories WHERE category_id = :id";
                                                                    $stmt = $pdo->prepare($sql);
                                                                    $stmt->execute([
                                                                        ':id' => $_POST['id']
                                                                    ]);
                                                                    header("Location: categories.php");
                                                                }
                                                            ?>
                                                            <?php 
                                                                if($category_total_posts == 0) { ?>
                                                                    <form action="categories.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $category_id; ?>" />
                                                                        <button name="delete-category" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                                    </form>  
                                                                <?php } else { ?>
                                                                    <button title="You can't delete category having a post!" name="delete-category" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                                <?php }
                                                            ?>
                                                               
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

<?php require_once('./includes/footer.php'); ?>