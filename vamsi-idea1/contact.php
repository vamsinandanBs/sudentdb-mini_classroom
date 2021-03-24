<?php $current_page = "Contact us"; ?>
<?php require_once("./includes/header.php"); ?>

        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    
                    <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                        <div class="container">
                            <a class="navbar-brand text-dark" href="index.php">Vamsi-Pramod</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><img src="./img/menu.png" style="height:20px;width:25px" /><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-5">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home </a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                    
                                </ul>
                                <?php 
                                    $curr_page = basename(__FILE__);
                                    require_once("./includes/registration.php");
                                ?>
                            </div>
                        </div>
                    </nav>
                    <div class="row">
                                <div class="col-md-6 col-xl-4 mb-5">
                                    <a class="card post-preview lift h-100" href="http://localhost:8080/vamsi-idea1/Snow/"
                                        ><img class="card-img-top" src="./Snow/stdb.jpg" alt="photo" />
                                       
                                        <div class="card-footer">
                                            <div class="post-preview-meta">
                                             
                                                <div class="post-preview-meta-details">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                    </div>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                        <div class="page-header-content pt-10">
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <h1 class="page-header-title mb-3">Contact Us</h1>
                                        <p class="page-header-text">ask your doubts with lecturers and replay! its secured</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </header>
                    <section class="bg-white py-10">
                        <div class="container">

                            <?php 
                                if(isset($_COOKIE['_uid_']) || isset($_COOKIE['_uiid_']) || isset($_SESSION['login'])) { ?>
                                    <form action="contact.php" method="POST">
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
                                            $user_email = $user['user_email'];

                                            if(isset($_POST['send'])) {
                                                $message = trim($_POST['message']);
                                                $sql = "INSERT INTO messages SET ms_username = :username, ms_useremail = :email, ms_detail = :detail, ms_date = :date";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute([
                                                    ':username' => $user_name,
                                                    ':email' => $user_email,
                                                    ':detail' => $message,
                                                    ':date' => date("d-m-Y "). ' at ' . date("H:i:s")
                                                ]);
                                                echo "<p class='alert alert-success'>Message has been send successfully!</p>";
                                            }
                                        ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-dark" for="inputName">Full name</label>
                                                <input value="<?php echo $user_name; ?>" readonly="true" class="form-control py-4" id="inputName" type="text" placeholder="Full name" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="text-dark" for="inputEmail">Email</label>
                                                <input value="<?php echo $user_email; ?>" readonly="true" class="form-control py-4" id="inputEmail" type="email" placeholder="name@example.com" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark" for="inputMessage">Message</label>
                                            <textarea name="message" class="form-control py-3" id="inputMessage" type="text" placeholder="Enter your message..." rows="4"></textarea>
                                        </div>
                                        <div class="text-center">
                                            <button name="send" class="btn btn-primary btn-marketing mt-4" type="submit">Submit Request</button>
                                        </div>
                                    </form>



                                    <table class="table table-bordered table-hover mt-5" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Your messages:</th>
                                                <th>Answers:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql1 = "SELECT * FROM messages WHERE ms_useremail = :email";
                                                $stmt1 = $pdo->prepare($sql1);
                                                $stmt1->execute([
                                                    ':email' => $user_email
                                                ]);
                                                while($ms = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                    $ms_detail = $ms['ms_detail'];
                                                    $reply = $ms['reply']; ?>
                                                    <tr>
                                                      <td><?php echo $ms_detail; ?></td>
                                                      <td><?php echo $reply; ?></td>
                                                  </tr>
                                                <?php }                                                  
                                            ?>
                                        </tbody>
                                    </table>


                               <?php } else { ?>
                                    <a href="./backend/sign-in.php">Sign in to contact us!</a>
                               <?php }
                            ?>
                            

                        </div>

                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </section>
                </main>
            </div>
            <div id="layoutDefault_footer">
                <footer class="footer pt-4 pb-4 mt-auto bg-dark footer-dark">
                    <div class="container">
                        <hr class="my-1" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &#xA9; Your Website 2020</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="privacy-policy.php">Privacy Policy</a>
                                &#xB7;
                                <a href="terms-conditions.php">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<?php require_once("./includes/footer.php"); ?>