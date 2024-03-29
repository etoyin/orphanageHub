<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>OrphanageHub | <?=$title?></title>
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- favicons -->
    <link rel="shortcut icon" href="<?=base_url('images/favicon.ico')?>">
    <!-- Style CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('public/fonts/jost/stylesheet.css')?>" /> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/libs/line-awesome/css/line-awesome.min.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/libs/fontawesome-pro/css/fontawesome.css')?>" />
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('public/libs/bootstrap/css/bootstrap.min.css')?>" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/css/style.css')?>" />
    
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/css/registration_form.css')?>" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    
    

    <!-- orther script -->
    <script src="<?=base_url('public/js/main.js')?>"></script>
    <script src="<?=base_url('public/js/nav_active.js')?>"></script>
</head>

<body>
    <div id="wrapper">
        <header id="header" class="">
        <nav class="navbar navbar-default fixed-top navbar-dark navbar-expand-lg navi-bar justify-content-center" >
            <div class="pl-4 container-fluid nav-div">
                <a class="navbar-brand" style="height: 100%;" href="<?=base_url('Home/index')?>">
                    <img id="logo" src="<?=base_url('public/images/logo1.png')?>" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto links">
                        <?php
                            if ($this->session->userdata('id'))
                            {
                                echo '<a data="home" class="nav-item nav-link ml-5 active" href="'.base_url('Dashboard/index').'">Dashboard <span class="sr-only">(current)</span></a>';
                            }
                            else{
                                echo '<a data="home" class="nav-item nav-link ml-5 active" href="'.base_url('Home/index').'">Home <span class="sr-only">(current)</span></a>';
                            }
                        ?>
                        
                        
                        <!-- <a data="about" class="nav-item nav-link ml-5 active" href="<?=base_url('About')?>">About Us</a> -->
                        <a data="orphanages" class="nav-item nav-link ml-5 active" href="<?=base_url('Children_Homes/index')?>">Orphanages</a>
                        <a data="events" class="nav-item nav-link ml-5 active" href="<?=base_url('Events/index')?>">Events</a>
                        <a data="blog" class="nav-item nav-link ml-5 active" href="<?=base_url('Blog/index')?>">Blog</a>
                        <a data="donate" class="nav-item nav-link ml-5 active" href="<?=base_url('Donate/index')?>">Donate</a>
                        <?php
                            if ($this->session->userdata('id'))
                            {
                                echo '<a data="register" class="nav-item nav-link ml-5 active" href="'.base_url('Dashboard/logout').'">Logout</a>';
                            }
                            else{
                                echo '<a data="register" class="nav-item nav-link ml-5 active" href="'.base_url('Login/index').'">Register/Login</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        </header><!-- .site-header -->
