<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>

    <style>
        p.search{
            text-align: center;
            margin: 20px 0;
        }
    </style>

</head>
<body>
    <a href="addUser.php">Add Account</a>

    <?php
    require_once "account.class.php";

    $accObj = new Account;
    $array = $accObj->showAll();
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Account_Type</th>
            <th>Actions</th>
        </tr>
        <?php
        $i = 0;

        if(empty($array)){
            ?>
            <tr>
                <td colspan ="7">
                    <p class="seach">No Accounts</p>
                </td>
            </tr>
            <?php
        }

        foreach($array as $arr){
            $i++;
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $arr['name'] ?></td>
                <td><?= $arr['email'] ?></td>
                <td><?= $arr['password'] ?></td>
                <td><?= $arr['account_type'] ?></td>
                <td><a href="editAccount.php?id=<?= $arr['account_id'] ?>">Edit</a></td>
            </tr>
            <?php
        }
        
        ?>
    </table>

</body>
</html>