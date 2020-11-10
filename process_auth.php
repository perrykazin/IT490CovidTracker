<?php

    include 'connect/connect.php';
    $_SESSION['loggedIn'] = false;
    if (isset($_POST['user']) && isset($_POST['password'])){
        //Passed values from the form
        $username = $_POST['user'];
        $password = $_POST['password'];

        //mysql injection protection
        $username = mysqli_escape_string($link, trim($username));
        $password = mysqli_escape_string($link, trim($password));

        $query = "SELECT * FROM USERS WHERE USER_EMAIL = '$username'";
        $result = mysqli_query($link, $query) or 
                  die("Failed to load the query from DB".mysqli_error($link));
        $row = mysqli_fetch_array($result);
        if ($password == $row['USER_PASSWORD']) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['name'] = $row['USER_FIRST_NAME'];
            $_SESSION['eID'] = $row['USER_EMAIL'];
            $_SESSION['role'] = $row['ROLE_ID'];
            $_SESSION['dID'] = $row['D_ID'];
            $roleId = $row['ROLE_ID'];
            if($roleId == 1){
                echo 'admin logged in';
                header("Location: homepage_admin.php");
            }
            if($roleId == 2){
                echo 'Clerk logged in';
                header("Location: homepage_user.php");
            }
          }
          else {
            header("Location: login_page.php");
            echo 'try again';
          }
    }
    mysqli_close($db);
?>