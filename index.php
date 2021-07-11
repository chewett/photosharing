<?php
$config = json_decode(file_get_contents("config.json"), true);

$IMAGES_DIR = $config['images'];
$columnSize = 4; //must divide max_size nicely into this
$COLUMN_MAX_SIZE = 12;
$COLUMN_NO = $COLUMN_MAX_SIZE / $columnSize;

$pageTitle = $config['title'];

$filenames = [];
foreach(glob($IMAGES_DIR . '/*') as $filename){
    $filenames[] = basename($filename);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$pageTitle?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lightbox -->
    <link href="vendor/lokesh/lightbox2/dist/css/lightbox.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <div class="jumbotron">
        <h1><?=$pageTitle?></h1>
        <p class="lead">
            <?=$config['description']?>
        </p>

        <?php
        if($config['downloads']) {
            ?>
            <h2>Download</h2>
            <p>
                <?php
                foreach($config['downloads'] as $dl) { ?>
                    <a target="_blank" href="<?=$dl['href']?>"><?=$dl['description']?></a>
                    <?php
                }
                ?>
            </p>

            <?php
        }
        ?>

    </div>

    <?php
    $filenameCount = count($filenames);
    for($i = 0; $i < $filenameCount; $i++) {
        if($i % $COLUMN_NO === 0) {?>
            <div class="row" style="margin-top:5%; ">
            <?php
        }
            ?>
                <div class="col-md-4">
                    <a data-lightbox="groupname" href="<?=$IMAGES_DIR?><?=$filenames[$i]?>">
                        <img class="img-responsive" src="<?=$IMAGES_DIR?><?=$filenames[$i]?>" /> <br />
                        <?=$filenames[$i]?>
                    </a>
                </div>
            <?php
        if($i % $COLUMN_NO === ($COLUMN_NO - 1)) { ?>
            </div>
            <?php
        }

    }

    if($i % $COLUMN_NO !== ($COLUMN_NO - 1)) { ?>
        </div>
        <?php
    }

    ?>

    <footer class="footer">
        <hr />
        <p>The source code is available on
            <a href="https://github.com/chewett/photosharing">
                github.com/chewett/photosharing
            </a>
        </p>
    </footer>

</div> <!-- /container -->


<script src="vendor/lokesh/lightbox2/dist/js/lightbox-plus-jquery.js"></script>
</body>
</html>
