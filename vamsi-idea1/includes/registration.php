<?php 
    
    if(isset($_POST['reset'])) {

        if(isset($_SESSION['login'])) {
            session_destroy();
            unset($_SESSION['login']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_nickname']);
            unset($_SESSION['user_role']);
        }

        if(isset($_COOKIE['_uid_']) && isset($_COOKIE['_uiid_'])) {
            setcookie('_uid_', '', time() - 60 * 60 * 24, '/', '', '', true);2
            setcookie('_uiid_', '', time() - 60 * 60 * 24, '/', '', '', true);
        }

        header("Location: {$curr_page}");

    }

    if(isset($_SESSION['login'])) { 
        $user_id = $_SESSION['user_id'];
        $user_nickname = $_SESSION['user_nickname'];
        $sql = "SELECT * FROM users WHERE user_id = :id AND user_nickname = :nickname";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $user_id,
            ':nickname' => $user_nickname
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_name = $user['user_name'];
        $user_role = $user['user_role'];
        $_SESSION['user_name'] = $user_nickname;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['login'] = 'success';
        ?>
        <form action="<?php echo $curr_page; ?>" method="POST">
            <button name="reset" class="btn-teal btn rounded-pill px-4 ml-lg-4">Sign out (<?php echo $user_name; ?>)</button>
        </form>
    <?php } else {
        if(!isset($_COOKIE['_uid_']) && !isset($_COOKIE['_uiid_'])) {
            echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signin.php">Sign in</a>';
            echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signup.php">Sign up</a>';
        } else {
            $user_id = base64_decode($_COOKIE['_uid_']);
            $user_nickname = base64_decode($_COOKIE['_uiid_']);
            $sql = "SELECT * FROM users WHERE user_id = :id AND user_nickname = :nickname";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id' => $user_id,
                ':nickname' => $user_nickname
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_name = $user['user_name'];
            $user_role = $user['user_role'];
            $_SESSION['user_name'] = $user_nickname;
            $_SESSION['user_role'] = $user_role;
            $_SESSION['login'] = 'success'; 
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_nickname'] = $user_nickname; ?>
            <form action="<?php echo $curr_page; ?>" method="POST">
                <button name="reset" class="btn-teal btn rounded-pill px-4 ml-lg-4">Sign out (<?php echo $user_name; ?>)</button>
            </form>

       <?php }
        
    }
?>