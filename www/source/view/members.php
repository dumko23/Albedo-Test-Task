<?php

use App\core\Application;

require  './vendor/autoload.php';

$config = require('source/config.php');

include('source/view/layouts/header.php')
?>
<a href="/">Back to Register Form</a>
<div class="memberList">
    <?php
    $members = new Application();
    $members->view->showMembers($config);
    ?>
</div>
</body>
</html>
