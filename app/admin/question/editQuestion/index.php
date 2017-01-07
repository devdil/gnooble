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

$queryResult = Admin::getQuestionByQuestionId($_GET['qid']);
$testCases = Admin::getTestCasesByQuestionId($_GET['qid']);

$testCaseCount = count($testCases);

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
                <li><a href="../../">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="../../question/">Practice Questions</a></li>
                <li><a href="../../submissions/">My Submissions</a></li>
                <li><a href="../../Challenges/">Challenges</a></li>
            </ul>
        </section>
        <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Edit Question</h1>
            <div class="alert-success" id="status"></div>

                <label>Select Question Type</label>
                <select  id="qType" name="qType">
                    <option value="0">Practice Question</option>
                </select>
                <form class="question-form form-horizontal" id="question-form">
                 <?php if(isset($queryResult[0]["questionName"])): ?>
                <div class="form-group">
                    <input type="text" value="Question" name="type" hidden/>
                    <label for="input-qname" class="col-sm-2 control-label">Question Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-qName" value="<?php echo $queryResult[0]["questionName"]; ?>" name="input-qName" placeholder="What's the programming question? Be specific." >
                    </div>
                </div>
                 <?php endif; ?>
                 <?php if(isset($queryResult[0]["questionStatement"])): ?>
                <div class="form-group">
                    <label for="input-qDesc" class="col-sm-2 control-label">Question Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="input-qDesc" name="input-qDesc" placeholder="Describe the problem statement"><?php echo $queryResult[0]["questionStatement"]; ?></textarea>
                    </div>
                </div>
                    <?php endif;?>
                    <?php if(isset($queryResult[0]["difficulty"])): ?>
                    <div class="form-group">
                        <label for="difficulty" class="col-sm-2 control-label">Difficulty Level</label>
                        <div class="col-sm-10">
                            <select id="difficulty" name="difficulty" class="form-control">
                                <option value="Easy" <?php if($queryResult[0]["difficulty"]=== "20") echo "selected";?>>Easy</option>
                                <option value="Medium" <?php if($queryResult[0]["difficulty"]=== "50") echo "selected";?>>Medium</option>
                                <option value="Hard" <?php if($queryResult[0]["difficulty"]=== "100") echo "selected";?>>Hard</option>
                            </select>
                        </div>
                    </div>
                        <?php endif;?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Test Cases</label>
                            <div class="col-sm-10">
                                <p class="help-block">Put the expected input and expected output in a text file and upload it here.</p>
                               <?php $counter = 1; ?>
                               <?php foreach($testCases as $testCase):?>
                                <table class="table table-bordered">
                                   <caption><strong>Test Case <?php echo $counter; ?></strong></caption>
                                    <tr>
                                        <th>Expected Input</th>
                                        <th>Expected Output</th>
                                    </tr>
                                    <tr>
                                        <td><textarea class="form-control" id="input-expected" name='input-inputTestCase-<?php echo $testCase['tid'];    ?>' ><?php echo $testCase["inputCase"];?></textarea></td>
                                        <td><textarea class="form-control" id="output-expected" name='output-outputTestCase-<?php echo $testCase['tid']; ?>' ><?php echo $testCase["outputCase"];?></textarea></td>
                                    </tr>
                                </table>
                                <?php $counter++; ?>
                            <?php endforeach;?>
                            </div>
                        </div>

            <?php if(isset($queryResult[0]["questionName"])): ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 pull-right">
                    <input type="submit" id="submit" name="updateQuestion" value="Update Question" class="btn btn-default btn-lg btn-success pull-right">
                </div>
            </div>
            <?php endif;?>
            </form>
        </section>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>
<script src="../../../assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#input-qDesc",
        content_css : "../../../assets/css/bootstrap.min.css",
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
<script>
    $(document).ready(function(){
        $('#status').hide();
    });
</script>
<script>
    // AJAX Code Here
        $('.question-form').on('submit', function (e) {
            // Okay, we need to get value from textbox name and score
            // When user click on the add button
            // Let make a AJAX request
            tinymce.triggerSave();
            e.preventDefault();
            $.ajax({
                url: 'updateQuestion.php?qid='+"<?php echo $_GET['qid'];?>",
                crossDomain: true,
                type: 'POST', // making a POST request
                dataType: "json",
                data: $("#question-form").serialize(),
                success: function (data) {
                    // this function will be trigger when our PHP successfully
                    // response (does not mean it will successfully add to database)
                    if (data["result"] == "QSuccess" || data["result"] == "QFailed") {
                        $('#status').html(data["outcome"]);
                        $('#status').show();
                        alert(data["outcome"]);
                    }
                },
                error: function (msg) {
                    alert(msg);
                    console.log(msg);
                    //$("#compile").removeAttr("disabled");
                }
            });
        });
</script>
</body>
</html>