<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Dashboard Future Jobs</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="<?php echo base_url()?>css/styles.css" rel="stylesheet">
    <script src="<?php echo base_url()?>js/ckeditor.js"></script>
    <script src="<?php echo base_url()?>js/sample.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>lib/toolbarconfigurator/lib/codemirror/neo.css">
    <?php
    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    ?>

    <?php
    if ($_SESSION['lang'] == "en")
    {

        $this->lang->load("msg", "english");
          }
    else
    {
        $this->lang->load("msg", "arabic");
          }
    ?>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <span class="glyphicon glyphicon-wrench"></span>
               Future Jobs
            </a>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li><a href="<?php echo site_url('user')?>">Users</a></li>
                <li><a href="<?php echo site_url('about/edit')?>">About</a></li>
                <li><a href="<?php echo site_url('category')?>">Category</a></li>
                <li><a href="<?php echo site_url('country')?>">Country</a></li>
                <li><a href="<?php echo site_url('foreign_labor')?>">Foreign labor</a></li>
                <li><a href="<?php echo site_url('job')?>">Jobs</a></li>
                <li><a href="<?php echo site_url('change_lang')?>"><?php echo $this->lang->line('lang');?></a></li>
                <li><a href="<?php echo site_url('logout')?>">Logout</a></li>
                <li><a href="<?php echo site_url('advertisement')?>">advertisement</a></li>


            </ul>

        </div>
    </div>
</nav>

<div class="container-fluid">

    <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

            <ul class="nav nav-sidebar">
                <li class="active">
                    <a href="#">
                        <span class="glyphicon glyphicon-dashboard"></span>
                        Options
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('user')?>">
                        <span class="glyphicon glyphicon-user"></span>
                        Users
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('about/edit')?>">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        About
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('category')?>">
                        <span class="glyphicon glyphicon-tags"></span>
                        Category
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('country')?>">
                        <span class="glyphicon glyphicon-globe"></span>
                        Country
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('foreign_labor')?>">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                        Foreign labors
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('job')?>">
                        <span class="glyphicon glyphicon-wrench"></span>
                        Jobs
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('advertisement')?>">
                        <span class="glyphicon glyphicon-share-alt"></span>
                        Advertisement
                    </a>
                </li>

            </ul>

        </div>
        <!--/span-->
        <div class="col-sm-9 col-md-10 main">
            <?php
            if (isset($data))
            {
                $this->load->view($content, $data);
            } else
            {
                $this->load->view($content);
            }

            ?>
        </div><!--/row-->
    </div>
</div><!--/.container-->

<footer>
    <p class="pull-right">©2015 ExpertsKey</p>
</footer>

<!-- script references -->
<script src="<?php echo base_url()?>js/jquery-2.1.3.js"></script>
<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/scripts.js"></script>
<?php if (isset($data['script'])) {
    ?>
    <script src="<?php echo base_url()?>js/<?php echo $data['script']?>"></script>
<?php
}
?>

</body>
</html>
