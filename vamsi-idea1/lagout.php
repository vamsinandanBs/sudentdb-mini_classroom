<?php 
	session_start();

	if(isset($_SESSION['login'])) {
        session_destroy();
        unset($_SESSION['login']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_nickname']);
        unset($_SESSION['user_role']);
    }

    if(isset($_COOKIE['_uid_']) && isset($_COOKIE['_uiid_'])) {
        setcookie('_uid_', '', time() - 60 * 60 * 24, '/', '', '', true);
        setcookie('_uiid_', '', time() - 60 * 60 * 24, '/', '', '', true);
    }

    header("Location: index.php");

?>