<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cocobox - A pet adoption game</title>
    <meta name="description" content="Cocobox is a pet adoption browser game - dress your pet up, decorate your island, and make new friends! Sign up now.">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <meta http-equiv="cleartype" content="on">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('favicon.ico') ?>"/>

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#222222">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url('js/vendor/modernizr-2.7.1.min.js') ?>"></script>
    <link href="<?php echo base_url('css/normalize.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/main.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <?php if ($this->user): ?>
                            <a class="nav-link" href="<?php echo base_url('world') ?>">Game</a>
                        <?php else: ?>
                            <a class="nav-link" href="<?php echo base_url('user/login') ?>">Game</a>
                        <?php endif ?>
                    </li>
                </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <?php if ($this->user): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('settings/edit') ?>"><?php echo $this->user->username ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="my-beans"><?php echo $this->currency_model->get_beans() ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('user/logout') ?>">Log Out</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('user/login') ?>">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('user/signup') ?>">Sign Up</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main role="main" class="container">
        <div class="row">