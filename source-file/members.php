<?php
namespace App;
require __DIR__ . '/../vendor/autoload.php';

PDOAdapter::db();
//PDOAdapter::insertToDB('sds', 'sdsd', 12223,'sdsd', 'dsds', 'sdsd', 'sdsd');
$list = PDOAdapter::getFromDB();
echo '<pre>';
print_r($list);
echo '</pre>';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="memberList">
<?php
foreach ($list as $member) {
    echo "<li> <span>name: {$member['firstName']}</span>
            <h4>user: {$member['lastName']}</h4>
            <p>email: {$member['email']}</p>
            <span>photo: {$member['photo']}</span>
            </li>
            ";
}
?>
</div>
</body>
</html>
