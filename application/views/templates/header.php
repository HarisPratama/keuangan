<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/img/smp.jpg'); ?>" />
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .sidebar {
            animation: colorchange 30s;
            /* animation-name followed by duration in seconds*/
            /* you could also use milliseconds (ms) or something like 2.5s */
            -webkit-animation: colorchange 30s;
            /* Chrome and Safari */
        }

        @keyframes colorchange {
            0% {
                background: rgba(255, 107, 107, 1.0);
            }

            25% {
                background: rgba(255, 159, 67, 1.0);
            }

            50% {
                background: rgba(95, 39, 205, 1.0);
            }

            75% {
                background: rgba(116, 185, 255, 1.0);
            }

            100% {
                background: rgba(232, 67, 147, 1.0);
            }
        }

        @-webkit-keyframes colorchange

        /* Safari and Chrome - necessary duplicate */
            {
            0% {
                background: rgba(255, 107, 107, 1.0);
            }

            25% {
                background: rgba(255, 159, 67, 1.0);
            }

            50% {
                background: rgba(95, 39, 205, 1.0);
            }

            75% {
                background: rgba(116, 185, 255, 1.0);
            }

            100% {
                background: rgba(232, 67, 147, 1.0);
            }
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">