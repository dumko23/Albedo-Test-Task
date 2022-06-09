<?php
namespace App;
require __DIR__ . '/../vendor/autoload.php';

$config = require('config/config.php');

include ('view/layouts/header.php')
?>
<a href="index.php">Back to Register Form</a>
<div class="memberList">
    <?php
    $members = new View();
    $members->showMembers($config);
    ?>
</div>
</body>
</html>
