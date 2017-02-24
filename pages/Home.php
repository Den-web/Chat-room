<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>
        <title>Chat Room</title>
        <script>
            $(document).ready(function () {

                $("#ChatText").keyup(function(e){
                    if(e.keyCode == 13){
                        var ChatText = $("#ChatText").val();
                        $.ajax({
                            type: 'POST',
                            url:  'InsertMessage.php',
                            data:{ChatText:ChatText},
                            success:function(){
                                $("#ChatMessages").load("DisplayMessages.php");
                                $('#ChatText').val("");
                            }
                        });
                    }
                });

                setInterval(function () { //Refresh Every 1500ms
                    $("ChatMessages").load("DisplayMessage.php");
                }),1500;

                $("#ChatMessages").load("DisplayMessages.php");

            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h2 class="text-center">Welcome to Chat Box<span style="color:green"><?php $_SESSION['UserName']; ?></span></h2>

                    <div id="ChatBig">
                        <h3>Chat Block</h3>
                        <div id="ChatMessages">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Your Message</label>
                            <textarea name="ChatText" id="ChatText" class="form-control" rows="3"></textarea>

                        </div>
                    </div>
                </div>  <!-- col-md-4 end-->
            </div><!-- row end-->
        </div><!-- container end-->
    </body>
</html>