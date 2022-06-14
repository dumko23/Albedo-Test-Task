<?php

include('source/view/layouts/header.php')
?>
<a href="/">Back to Register Form</a>
<div class="memberList">
    <?php

    $app->view->showMembers($app->getConfig());
    ?>
</div>

<a style="position: fixed; bottom: 0; left: 0;" href="#">To the top</a>
</body>
</html>
