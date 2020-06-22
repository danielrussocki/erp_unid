<?php
require_once "./config/config.php";
require_once ROOT_PATH . "/libs/database.php";
session_start();
error_reporting(0);
$id_usr = $_SESSION["id"];
if (isset($id_usr)) {
?>
    <!DOCTYPE html>
    <html lang="mx">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, 
        user-scalable=no, shrink-to-fit=no" />
        <link rel="stylesheet" href="<?php echo constant("URL") ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant("URL") ?>/style.css" />
        <script src="<?php echo constant("URL") ?>/vendor/components/jquery/jquery.min.js"></script>
        <title>Dashboard</title>
    </head>

    <body>
        <!-- Full Container -->
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <?php include(ROOT_PATH . "/includes/navbar.php"); ?>
            <!-- Container app main -->
            <div class="app-main">
                <?php include(ROOT_PATH . "/includes/sidenav.php"); ?>
                <!-- App Content -->
                <div class="app-main__outer">
                    <!-- Content -->
                    <div class="app-main__inner">
                        <h1>Dashboard</h1>
                    </div>
                    <!-- Footer -->
                    <?php include(ROOT_PATH . "/includes/footer.php"); ?>
                </div>
                <!-- /App Content -->
            </div>
            <!-- /Container app main -->
        </div>
        <!-- /Full Container -->
        <script type="text/javascript" src="<?php echo constant("URL") ?>/assets/scripts/main.js"></script>
        <script src="<?php echo constant("URL") ?>/erp_modulos/modulos/main.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:" . URL . "/erp_modulos/login/index.php");
}
?>