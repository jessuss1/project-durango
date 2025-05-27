<?php

session_start();

// File for the DB Connection
include_once("DBConnect.php");

//  echo $host." + ". $user." + ".$pass." + ".$db_name;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //Name
    $reg_name = htmlspecialchars($_POST["reg_name"]);

    //First Last Name
    $reg_last_name1 = htmlspecialchars($_POST["reg_last_name1"]);

    //Second Last Name
    $reg_last_name2 = htmlspecialchars($_POST["reg_last_name2"]);

    //Username
    $reg_username = htmlspecialchars($_POST["reg_username"]);

    //Email, Using strtolower To Have The Email in Lower Case Before Being Sent To The DB
    $reg_email = strtolower(htmlspecialchars($_POST["reg_email"]));

    //Pasword
    $reg_password = $_POST["reg_password"];

    //Hashing The Password
    $reg_password_hashed = md5($reg_password);

    try {
    
        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("INSERT INTO user (name, first_last_name, second_last_name, username, email, password)
                               VALUES (:name, :first_last_name1, :second_last_name, :username, :email, :password)");


        $stmt->bindParam(':name', $reg_name);
        $stmt->bindParam(':first_last_name1', $reg_last_name1);
        $stmt->bindParam(':second_last_name', $reg_last_name2);
        $stmt->bindParam(':username', $reg_username);
        $stmt->bindParam(':email', $reg_email);
        $stmt->bindParam(':password', $reg_password_hashed);


        $stmt->execute();

        header('Location: login.php?status=reg_success');
        exit();

        
    } catch (PDOException $e) {

        //The Code 1062 Is For DB Duplication Errors
        if ($e->errorInfo[1] == 1062) { 

            if (strpos($e->getMessage(), 'username') !== false) {

               header('Location: login.php?status=username_taken');

            } else if (strpos($e->getMessage(), 'email') !== false) {

                header('Location: login.php?status=email_in_use');

            }
        } else {

            echo "Error: " . $e->getMessage();

        }
    }
}

