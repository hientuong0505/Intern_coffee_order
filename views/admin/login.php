<?php
    include '../../classes/adminlogin.php';
?>

<?php
    $adminClass = new AdminLogin();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_check = $adminClass->loginAdmin($username, $password);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Log in page</title>
</head>

<body>

    <section id="content">
        <form action="login.php" method="post">

            <div class="wrapper fadeInDown">
                <h3>LOG IN</h3>

                <span>
                    <?php 
                        if(isset($login_check))
                        {
                            echo $login_check;
                        }
                    ?>
                </span>

                <div id="formContent">
                    <!-- Tabs Titles -->


                    <!-- Login Form -->
                    <form>
                        <input type="text" id="username" class="fadeIn second form-control" name="username" placeholder="username">
                        <!-- <input type="password" id="password" class="fadeIn third form-control" name="password" placeholder="password"> -->
                        <input type="password" id="password" class="fadeIn second form-control" name="password" placeholder="password">
                        <input type="submit" class="fadeIn fourth " value="Log In">
                    </form>


                </div>
            </div>
        </form>
    </section>


</body>

</html>