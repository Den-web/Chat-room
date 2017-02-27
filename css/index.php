
<!--/**
 * Created by PhpStorm.
 * User: Den
 * Date: 23.02.2017
 * Time: 15:07
 */ -->

<html>
    <head>
        <title>Chet Box</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <script type="text/javascript" src="./js/jquery-1.12.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="LoginDiv">
                        <h2 class="text-center"><b>LOGIN FORM</b></h2>
                        <form action="pages/UserLogin.php" method="post">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="UserMailLogin">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="UserPasswordLogin">
                                </div>
                                <button type="submit" class="btn btn-default" value="LOG IN">LOG IN</button>

                                <?php
                                if(isset($_GET['error'])) {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><span style="color:red">ERROR LOGIN</span></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                        </form>
                    </div><!-- #LoginDiv end-->
                </div>  <!-- col-md-4 end-->
            </div><!-- row end-->
        </div><!-- container end-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="SignUpDiv">
                        <h2 class="text-center"><b>SIGN UP FORM</b></h2>
                        <form action="pages/InsertUser.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Your Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Your Name"  name="UserName">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="UserMail">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="UserPassword"></td>
                            </div>
                                <tr>
                                    <td></td>
                                    <button type="submit" class="btn btn-default" value="SIGN UP">SIGN UP</button>
                                </tr>
                                <?php
                                if(isset($_GET['success'])) {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><span style="color:green">UserInserted</span></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                        </form>
                    </div>
                </div>  <!-- col-md-4 end-->
            </div><!-- container end-->
        </div><!-- container end-->
    
    </body>
</html>