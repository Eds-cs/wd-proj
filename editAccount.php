<?php
error_reporting(E_ALL); // Report all errors 
ini_set('display_errors', 1); // Display errors on the screen

require_once 'cleanFunctions.php';
require_once 'account.class.php';

$name = $email = $password = $account_type = '';
$nameErr = $emailErr = $passwordErr = $account_typeErr = '';
$accObj = new Account();

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['id'])){

        $account_id = $_GET['id'];
        $record = $accObj->fetchRecordID($account_id);
        if(!empty($record)){
            $name = $record['name'];
            $email = $record['email'];
            $password = $record['password'];
            $account_type = $record['account_type'];
        } else {
            echo 'No account found';
            exit;
        }

    } else {
        echo 'No account found';
        exit;
    }
} elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
    $account_id = clean_input($_GET['id']);
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $password = clean_input($_POST['password']);
    $account_type = isset($_POST['account_type']) ? clean_input($_POST['account_type']) : '';

    if(empty($name)){
        $nameErr = 'Name is Required';

    }
    if(empty($email)){
        $emailErr = 'Email is Required';

    }
    if(empty($password)){
        $passwordErr = 'Password is Required';

    }
    if(empty($account_type)){
        $account_typeErr = 'Account type is Required';
    }

    if(empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($account_typeErr)){
        $accObj->name = $name;
        $accObj->email = $email;
        $accObj->password = $password;
        $accObj->account_type = $account_type;

        if($accObj->edit()){
            header('Location: account.php');
            exit;
        } else {
            echo 'Something went wrong with updating the Account.';

        }
    }
echo $name;
echo $email;
echo $password;
echo $account_type;
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
    <label for="name">Full Name: </label>
        <input type="text" name="name" id="name" value="<?= $name ?>">
        <br> 
        <?php
        if(!empty($nameErr)): ?>
            <span class="error"><?= $nameErr ?></span>
            <br>
            <?php endif;?>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" value="<?= $email ?>">
        <br>
        <?php
        if(!empty($emailErr)): ?>
            <span class="error"><?= $emailErr ?></span>
            <br>
            <?php endif;?>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" value="<?= $password ?>">
        <br>
        <?php
        if(!empty($passwordErr)): ?>
            <span class="error"><?= $passwordErr ?></span>
            <br>
            <?php endif;?>
            <label for="account_type">Account Type:</label>
            <select name="account_type" id="account_type">
                <option value="">---Select Account type---</option>
                <option value="student" <?= (isset($account_type) && $account_type == 'student') ? 'selected=true' : ''?>>Student</option>
                <option value="super_admin" <?= (isset($account_type) && $account_type == 'super_admin') ? 'selected=true' : ''?>>Super Admin</option>
                <option value="semi_admin" <?= (isset($account_type) && $account_type == 'semi_admin') ? 'selected=true' : ''?>>Semi Admin</option>
            </select>
            <br>
            <?php
        if(!empty($account_typeErr)): ?>
            <span class="error"><?= $account_typeErr ?></span>
            <br>
            <?php endif;?>
            <br>

            <input type="submit" value="Update Account">

            <?php echo $_SERVER['REQUEST_METHOD'];
            
            ?>
    </form>
</body>
</html>