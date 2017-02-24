<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 23.02.2017
 * Time: 15:58
 */

    include "classes.php";
    $user = new user();

    if ( isset($_POST['UserName']) && isset($_POST['UserMail']) && isset($_POST['UserPassword'])){
        $user->setUserName($_POST['UserName']);
        $user->setUserMail($_POST['UserMail']);
        $user->setUserPassword(sha1($_POST['UserPassword']));
        $user->InsertUser();

        header("location: ../index.php?success=1");





    }