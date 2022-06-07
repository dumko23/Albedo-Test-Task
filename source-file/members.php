<?php
namespace App;
require __DIR__ . '/../vendor/autoload.php';

PDOAdapter::db();

$list = PDOAdapter::getFromDB();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
<a href="index.php">Back to Register Form</a>
<div class="memberList">
    <?php
    foreach ($list as $member) {
        if($member['photo'] === ''){
            $member['photo'] = 'default-image.png';
        }
        echo "<table class='member-table'>
                <tr>
                    <td class='descr'>Photo</td>
                    <td><img src='{$member['photo']}' alt='user photo'></td>
                </tr>
                <tr>
                    <td class='descr'>Full Name</td>
                    <td>{$member['firstName']} {$member['lastName']}</td>
                </tr>
                <tr>
                    <td class='descr'>Report Subject</td>
                    <td>{$member['subject']}</td>
                </tr>
                <tr>
                    <td class='descr'>Email</td>
                    <td><a href='mailto:{$member['email']}'>{$member['email']}</a></td>
                </tr>
            </table>
            ";
    }
    ?>
</div>
</body>
</html>
