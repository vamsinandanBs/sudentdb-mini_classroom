<?php require_once("../includes/db.php"); ?>

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
                                    <span>Update Category</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($_POST['edit'])) {
                            $id = $_POST['edit-id'];
                            $url = "http://localhost:8080/vamsi-idea1/backend/edit-category.php?id=".$id;
                            header("Location: {$url}");
                        }
                    ?>

                    <!--Start Table-->
                    <div class="container-fluid mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Update Category</div>
                            <?php 
                                $sql = "SELECT * FROM categories WHERE category_id = :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':id' => $_GET['id']
                                ]);
                                $categories = $stmt->fetch(PDO::FETCH_ASSOC);
                                $category_title = $categories['category_name'];
                                $category_status = $categories['category_status']; 
                            ?>
                            <div class="card-body">
                                <?php 
                                    if(isset($_POST['update-category'])) {
                                        $cat_title = trim($_POST['category-title']);
                                        $category_status = $_POST['category-status'];
                                        $sql = "UPDATE categories SET category_name = :title, category_status = :status WHERE category_id = :id";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute([
                                            ':title' => $cat_title,
                                            ':status' => $category_status,
                                            ':id' => $_GET['id']
                                        ]);
                                        header("Location: categories.php");
                                    }
                                ?>
                                <form action="edit-category.php?id=<?php echo $_GET['id']; ?>" method="POST">
                                    <div class="form-group">
                                        <label for="cat-title">Category Name:</label>
                                        <input value="<?php echo $category_title; ?>" name="category-title" class="form-control" id="cat-title" type="text" placeholder="Category Name..." />
                                    </div>
                                    <div class="form-group">
                                        <label for="cat-status">Status:</label>
                                        <select name="category-status" class="form-control" id="cat-status">
                                            <option value="Published" <?php echo $category_status=='Published'?'selected':'';  ?>>Published</option>
                                            <option value="Draft" <?php echo $category_status=='Draft'?'selected':'';  ?>>Draft</option>
                                        </select>
                                    </div>
                                    <button name="update-category" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                </main>

 <?php require_once('./includes/footer.php'); ?>