<?php

include '../../../includes/Authenticate.php';
include '../../../classes/Admin.php';


		//check whether the user is logged in or not,
if (!Authenticate::isLoggedIn())
{
    Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() != "ADMIN")
{
    Authenticate::redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addQuestion']))
{


        if (!empty($_POST['input-qName']) && !empty($_POST['input-qDesc']))
        {

            $questionName = htmlspecialchars($_POST['input-qName']);
            $questionStatement= htmlspecialchars($_POST['input-qDesc']);
            $inputCases = trim(str_replace("\r\n","\n",file_get_contents($_FILES['input-inputTestCase']['tmp_name'])));
            $outputCases =trim(str_replace("\r\n","\n",file_get_contents($_FILES['output-outputTestCase']['tmp_name'])));
            $userId = $_SESSION['userid'];

            //assign difficult a integer value corresponding to their difficulty.
            switch ($_POST['difficulty']) {
                case "Easy":
                    $difficulty = 20;
                    break;
                case "Medium":
                    $difficulty = 50;
                    break;
                case "Difficult":
                    $difficulty = 100;
                    break;
            }

            //validate user and password from the database

            $isQuestionAddSuccessful = Admin::addQuestion($questionName,$questionStatement,$inputCases,$outputCases,$difficulty,$userId);
           // var_dump($isQuestionAddSuccessful);
            if ($isQuestionAddSuccessful)
                    $status  = 'Question Added Successfully!';
            else
                    $status = 'Please Check your form fields. and their values';


            }

}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gnooble: Student</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../../scripts/addQuestion.js" type="text/javascript"></script>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">John Doe <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Scoreboard</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
    <div class="row">
        <section class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="../">Home</a></li>
                <li class="active"><a href="../">Practice Questions <span class="sr-only">(current)</span></a></li>
                <li><a href="../../submissions/">My Submissions</a></li>
                <li><a href="../../reports/">Reports</a></li>
                <li><a href="../../assignments/">Assignments</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Add Tutorials</a></li>
                <li><a href="">Notifications</a></li>
            </ul>
        </section>
        <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Add Questions</h1>
            <p><?php if (isset($status)) echo $status;?></p>
            <form method="POST" action="index.php" enctype="multipart/form-data" class="form-horizontal col-sm-10 center-block pull-none question-form">
            <div>
                <div class="form-group">
                    <label for="input-qname" class="col-sm-2 control-label">Question Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-qName" name="input-qName" placeholder="What's the programming question? Be specific." >
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-qDesc" class="col-sm-2 control-label">Question Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="input-qDesc" name="input-qDesc" placeholder="Describe the problem statement" ></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Test Cases</label>
                <div class="col-sm-10">
                    <p class="help-block">Put the expected input and expected output in a text file and upload it here.</p>
                    <table class="table table-bordered">
                        <tr>
                            <th>Expected Input</th>
                            <th>Expected Output</th>
                        </tr>
                        <tr>
                            <td><input id="input-expected" type="file" name="input-inputTestCase"></td>
                            <td><input id="output-expected" type="file" name="output-outputTestCase"></td>
                        </tr>
                        <tr>
                            <td><input id="input-expected" type="file"></td>
                            <td><input id="output-expected" type="file"></td>
                        </tr>
                        <tr>
                            <td><input id="input-expected" type="file"></td>
                            <td><input id="output-expected" type="file"></td>
                        </tr>
                        <tr>
                            <td><input id="input-expected" type="file"></td>
                            <td><input id="output-expected" type="file"></td>
                        </tr>
                        <tr>
                            <td><input id="input-expected" type="file"></td>
                            <td><input id="output-expected" type="file"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="form-group">
                <label for="difficulty" class="col-sm-2 control-label">Difficulty Level</label>
                <div class="col-sm-10">
                    <select id="difficulty" name="difficulty" class="form-control">
                        <option value="Easy">Easy</option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 pull-right">
                    <button id="addQuestion" name="addQuestion" type="submit" class="btn btn-default btn-lg btn-success pull-right">Add Question</button>
                </div>
            </div>
            </form>
        </section>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>
<script src="../../../assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#input-qDesc",
        content_css : "../../assets/css/bootstrap.min.css",
        menubar: false,
        schema: "html5",
        plugins: "preview,code,image,link,paste",
        toolbar: "undo redo | styleselect | bold italic superscript subscript | link image | bullist numlist | outdent indent | code preview removeformat",
        font_formats: "Open Sans=Open Sans,Helvetica,Arial,sans-serif;Courier New=courier new,courier,monospace;",
        style_formats_merge: false,
        style_formats: [
            {title: "Headers", items: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"}
            ]},
            {title: "Inline", items: [
                {title: "Bold", icon: "bold", format: "bold"},
                {title: "Italic", icon: "italic", format: "italic"},
                {title: "Underline", icon: "underline", format: "underline"},
                {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
                {title: "Superscript", icon: "superscript", format: "superscript"},
                {title: "Subscript", icon: "subscript", format: "subscript"},
                {title: "Code", icon: "code", format: "code"}
            ]},
            {title: "Blocks", items: [
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ]},
            {title: "Alignment", items: [
                {title: "Left", icon: "alignleft", format: "alignleft"},
                {title: "Center", icon: "aligncenter", format: "aligncenter"},
                {title: "Right", icon: "alignright", format: "alignright"}
            ]}
        ],
        paste_as_text: true,
        paste_data_images: false,
        paste_retain_style_properties: " "
    });
</script>

</body>
</html>