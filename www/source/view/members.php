<?php


use App\core\View;

require __DIR__ . '../../vendor/autoload.php';

$config = require('source/config.php');

include('source/view/layouts/header.php')
?>
<a href="/">Back to Register Form</a>
<div class="memberList">
    <?php
    $members = new View();
    $members->showMembers($config);
    ?>
</div>
</body>
</html>
