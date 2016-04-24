<?php
require_once 'common.php';
read_config();
?>

<!DOCTYPE html>


<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $config['title']; ?></title>
        <link rel="stylesheet" href="lib/bootstrap.css">
        <link rel="stylesheet" href="lib/style.css">
        <link rel="stylesheet" href="lib/svg.css">
    </head>
    <body>
    <p><?php echo $config["wikiurl"] ?></p>
        <div id="split-container">
            <p>
            <?php $node="$wikiurl/Nodes"; $edge="$wikiurl/Edges" ?>
            <a href="<?php echo $node ?>" class="btn btn-default nav-button" role="button">
                Add/Edit nodes
            </a>
            <a href="<?php echo $edge ?>" class="btn btn-default nav-button" role="button">
                Add/Edit edges
            </a>
            <a href="./refresh.php" class="btn btn-default nav-button" role="button">
                Refresh
            </a>
            </p>
            <div id="graph-container">
                <div id="graph"></div>
            </div>
            <div id="docs-container">
                <a id="docs-close" href="#">&times;</a>
                <div id="docs" class="docs"></div>
            </div>
            <script src="lib/jquery-1.11.3.min.js"></script>
            <script src="lib/d3.min.js"></script>
            <script src="lib/colorbrewer.js"></script>
            <script src="lib/geometry.js"></script>
            <script>
                var config = <?php echo json_encode($config); ?>;
            </script>
            <script src="script.js"></script>
        </div>
    </body>
</html>