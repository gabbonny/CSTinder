<?php

function generatePage($body, $title="Example") {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>$title</title>
        <script src="group.js"></script>
    </head>

    <body>
            $body
    </body>
</html>
EOPAGE;
    return $page;
}
?>
