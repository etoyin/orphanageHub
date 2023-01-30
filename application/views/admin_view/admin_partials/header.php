<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin | <?=$title?></title>
<link rel="stylesheet" href="<?=base_url('public/css/admin.css')?>">
<link rel="stylesheet" href="<?=base_url('public/css/calendar.css')?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?= base_url('public/libs/line-awesome/css/line-awesome.min.css')?>" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://cdn.tiny.cloud/1/dcls5swlc3r8jfa5fn4vnn6yegio0jfjfy9lxdgd6s6wxto8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script> -->
</head>
<body>
<div class="body">
    <div id="leftSidenav" class="leftSidenav">
        <div class="closebtn"><i class="las la-window-close"></i></div>
        <div style="background-color: #060629">
            <a class="navbar-brand" style="height: 100%" href="<?=base_url('Admin_Dashboard/index')?>">
                <img id="logo" height="100%" width="100%" src="<?=base_url('public/images/orphanage-crop-navyblue-bg.png')?>" alt="">
            </a>
        </div>
        <div>
            <a href="add_admin_view">Add an Admin</a>
        </div>
        <div>
            <a href="all_admin_view">View Admin</a>
        </div>
        <div>
            <a href="all_orphanages_view">Verify Orphanages</a>
        </div>
        <div class="d-flex justify-content-between" >
            <div>
                <a href="#">Blog</a>
            </div>
            <div class="text-light">
                <a class="arrow-toggle"><i class="las la-angle-down"></i></a>
            </div>
        </div>
        <section class="blog-menu pl-3 text-light">
            <ul class="list-group">
                <a href="add_post_view"><li class="list-group-item bg-transparent">Write Post</li></a>
                <a href="add_post_category"><li class="list-group-item bg-transparent">Create Categories</li></a>
                <a href="#"><li class="list-group-item bg-transparent">View Posts</li></a>
            </ul>
        </section>
        <div>
            <a href="#">Item</a>
        </div>
    </div>

    <div id="main">
        <!-- <div class="top1">
            <div class="content">
                HOME <span class="gt">></span> OC <span class="gt">></span> <span  class="it">Item Search</span>
            </div>
        </div> -->
        <div class="top2">
            <div class="content d-flex">
                <div onclick="" id="menu-icon" class="menu-icon mr-3">&#9776;</div>
                <div>
                    <h3>
                        <a style="text-decoration: none" href="Admin_Dashboard">Home</a>
                    </h3>
                </div>
            </div>
            <div class="content-right">
                
                <div class="plus-icon"><i class="las la-user-tie"></i></div>
            </div>
        </div>
