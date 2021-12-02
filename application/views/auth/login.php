<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>LOGIN | <?php echo $this->config->item('app_name') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="Ade Muchlis M Anwar" name="author" />

    <link href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url() ?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo base_url() ?>assets/css/style-metronic.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/style-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/themes/default.css" rel="stylesheet" type="text/css"
        id="style_color" />
    <link href="<?php echo base_url() ?>assets/css/pages/login-soft.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="<?php echo site_url() ?>">
            <img src="<?php echo base_url() ?>assets/img/logo.png" alt="logo" width="100" />
        </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form id="login_form1" action="<?php echo site_url('auth/login'); ?>" method="post">
            <h3 class="form-title text-center">
                <?php echo $this->config->item('app_name') ?>
            </h3>

            <?php if ($message) : ?>
            <div class="alert alert-warning">
                <?php echo $message; ?>
            </div>
            <?php endif; ?>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <input type="text" id='identity' name='identity' class="form-control" placeholder="Username"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input id="password-field" type="password" class="form-control" autocomplete="false"
                        placeholder="Input Password" name="password" aria-label="Recipient's username"
                        aria-describedby="basic-addon2">
                    <span class="input-group-btn" onclick="show('newPass')">
                        <button type="button" class="btn"><i id="p" toggle="#password-field"
                                class="fa fa-fw fa-eye field-icon toggle-password"></i></button>
                    </span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn blue pull-right">
                    Login <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
            <div class="create-account">
                <p align="center" style="font-size: 14px;"><?php echo $this->config->item('sub_name') ?></p>
            </div>
        </form>
        <!-- END LOGIN FORM -->


    </div>
    <!-- END LOGIN -->
    <!-- BEGIN COPYRIGHT -->
    <div class="copyright">
        <?php echo date('Y'); ?> &copy; <?php echo $this->config->item('wil_name') ?>
    </div>

    <script src="<?php echo base_url() ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"
        type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript">
    </script>
    <script src="<?php echo base_url() ?>assets/scripts/core/app.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/scripts/custom/login-soft.js" type="text/javascript"></script>
    <script>
    jQuery(document).ready(function() {
        App.init();
        Login.init('<?php echo base_url() ?>');
    });

    function show(id) {
        var a = document.getElementById('password-field');
        $("#p").toggleClass("fa-eye fa-eye-slash");

        if (a.type == "password") {
            a.type = "text";
            $('#td_id').removeClass('fa-eye').addClass('fa-slash');
        } else {
            a.type = "password";

        }
    }
    </script>
</body>

</html>