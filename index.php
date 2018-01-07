<?php
require_once('./Kettler.php');
require_once('./Language.php');

include './functions.php';

define("KETTLER_DIR", "./kettler-files/");
define("TCX_DIR","./tcx-files/");

$uniqueness = date("Y-m-d_H:i:s_") .  uniqid();
$xml_file = KETTLER_DIR . $uniqueness . ".xml";
$tcx_file = TCX_DIR . $uniqueness . ".tcx";

//Turn off SimpleXML Warnings
libxml_use_internal_errors(true);

// set the language of the page
$lang = new Language();

?>

<!DOCTYPE html>
<html>
        <head>
        <title><?php echo $lang->get('title'); ?></title>
        <link rel="stylesheet" href="./styles.css">
        <link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave+Display" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Philipp Boksberger" />
        <meta name="keywords" content="<?php echo $lang->get('keywords'); ?>" />
        <meta name="description" content="<?php echo $lang->get('description'); ?>" />
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111396572-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-111396572-1');
        </script>
    </head>
    <body> 
        <div class="wrapper">
            <header>
                <div id="languages">
                    <a href="./index.php?lang=de">de</a>
                    &nbsp;|&nbsp;
                    <a href="./index.php?lang=en">en</a>
                </div>
                <h1><?php echo $lang->get('heading'); ?></h1>
                <p class="orange"><?php echo $lang->get('claim'); ?></p>
                <nav>
                    <ul>
                        <li><a href="#converter"><?php echo $lang->get('converter'); ?></a></li>
                        <li><a href="#devices"><?php echo $lang->get('devices'); ?></a></li>
                        <li><a href="#background"><?php echo $lang->get('background'); ?></a></li>
                        <li><a href="#contact"><?php echo $lang->get('contact'); ?></a></li>
                    </ul>
                </nav>
            </header>
            <main>
                <section id="converter">
                    <h2><?php echo $lang->get('converter'); ?></h2>
<?php       
if (isset($_FILES['kettlerFile'])) {    

    // Display Link for TCX file if converting works
    $response = convert($xml_file,$tcx_file);
    if ($response) {
        echo "                  <p>" . $lang->get('download') . " <a href='$tcx_file' download='training.tcx'>training.tcx</a></p>";
    }
} else {
?>
                    <form method="post" enctype="multipart/form-data">
                        <?php echo $lang->get('formtext'); ?>
                        <br />
                        <br />
                        <input type="file" name="kettlerFile" id="kettlerFile">
                        <br />
                        <br />
                        <input type="submit" value="<?php echo $lang->get('convertbutton'); ?>" name="submit">
                    </form>
<?php } ?>
                </section>
                <section id="devices">
                    <h2><?php echo $lang->get('supporteddevices'); ?></h2>
                    <p><?php echo $lang->get('devicestext1'); ?></p>            
                    <ul>
                        <li>Kettler Ergometer E5</li>
                    </ul>
                    <p><?php echo $lang->get('devicestext2'); ?></p> 
                </section>
                <section id="background">
                    <h2><?php echo $lang->get('background'); ?></h2>
                    <p><?php echo $lang->get('backgroundtext1'); ?></p>
                    <p><?php echo $lang->get('backgroundtext2'); ?></p>
                    <p><?php echo $lang->get('backgroundtext3'); ?></p>
                </section>
                <section id="contact">
                    <h2><?php echo $lang->get('contact'); ?></h2>
                    <p>Philipp: <a href="mailto:philipp@kettler2strava.com">philipp@kettler2strava.com</a></p>
                </section>
            </main>
            <footer>
            </footer>
        </div>
    </body>
</html>