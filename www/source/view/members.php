<?php

use App\core\Application;

require  './vendor/autoload.php';

include('source/view/layouts/header.php')
?>
<a href="/">Back to Register Form</a>
<div class="memberList">
    <?php
    $app = new Application();
    $app->view->showMembers($app->getConfig());
    ?>
</div>
</body>
</html>
