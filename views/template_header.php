<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gnooble: Student</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-59768309-1', 'auto');
        ga('send', 'pageview');

    </script>

</head>
<body>

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Gnooble</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo "Hello ".$_SESSION['username']." "; ?>
                        <li><a href="http://gnooble.org/logout/">Logout</a></li>
                </li>
            </ul>
        </div>    </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
    <div class="row">
        <section class="col-sm-3 col-md-2 sidebar"><ul class="nav nav-sidebar">
                <li><a href="/student/">Home <span class="sr-only">(current)</span></a></li>
                <li ><a href="/student/practice/">Practice</a></li>
                <li ><a href="/student/submissions/">MySubmissions</a></li>
                <li><a href="/student/contests/">Contests</a></li>
            </ul>

        </section>
        <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">