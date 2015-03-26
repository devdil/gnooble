<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gnooble: An automated programming judge</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-59768309-1', 'auto');
		ga('send', 'pageview');

	</script>

</head>
<body class="landing">

   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Gnooble</a>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
            <div class="navbar-right">
               <a class="navbar-btn btn btn-success" href="/register/">Sign Up</a>
               <a class="navbar-btn btn btn-default" href="/login/">Sign In</a>
            </div>
         </div><!--/.navbar-collapse -->
      </div>
   </nav>

	<div class="jumbotron">
	<div class="container-fluid">
       <div class="col-sm-6 pull-left">
          <h1>Gnooble</h1>
          <p>Gnooble is an intelligent platform to automate programming assignments on the cloud.
                          Built for institutions, trainers and students, it primarily aims to provide a place for students to practice coding challenges and improve their skills.</p>
          <p>Institutions and Trainers can leverage this platform by hosting hackathons and coding competitions and get insights on a student's skills.</p>
          <p>Sign Up and start practicing right away.</p>
       </div>
       <div class="col-sm-4 pull-right">
          <form action="/register/" method="post" class="clearfix entry-form">
             <h3>Create an account.</h3>
             <p><small>Its free!</small></p>
             <hr/>
             <div class="form-group">
                <label for="input-name">Full Name</label>
                <input required type="text" class="form-control" name="name" id="input-name" placeholder="What is your full name?">
             </div>
             <div class="form-group">
                <label for="input-email">Email</label>
                <input required type="email" class="form-control" name="emailid" id="input-email" placeholder="Your email address?">
             </div>
             <div class="form-group">
                <label for="input-tel">Contact Number</label>
                <input required type="tel" class="form-control" name="contactnumber" id="input-tel" placeholder="Your contact number?">
             </div>
             <div class="form-group">
                <label for="input-dept">Department</label>
                <select required name="department" id="input-dept" class="form-control">
                   <option value="CSE">Computer Science</option>
                   <option value="EE">Electrical Engineering</option>
                   <option value="ECE">Electronics Engineering</option>
                   <option value="IT">Information Technology</option>
                   <option value="FT">Food Technology</option>
                </select>
             </div>
             <div class="form-group">
                <label for="input-password">Password</label>
                <input required type="password" class="form-control" name="password" id="input-password" placeholder="Password">
             </div>
             <div class="form-group">
                <label for="input-secureid">Secure ID</label>
                <input required type="password" class="form-control" name="secureid" id="input-secureid" placeholder="Secure ID" >
                <p class="help-block">If you are a student, enter 14300 as SecureID</p>
             </div>
             <button type="submit" class="btn btn-success pull-right">Sign Up</button>
          </form>
       </div>

	</div>
	</div>

	<section class="features features-student container-fluid text-center">
		<!-- Three columns of text below the carousel -->
		<div class="row">
            <h2><strong>Gnooble for Students</strong></h2>
		  <div class="col-lg-4">
		    <img class="feature-img" src="assets/images/list.png" alt="Practice online">
		    <h2>Practice Online</h2>
		    <p>Gnooble provides an online platform for students to practice programming assignments online. Complete assignments, keep track of your scores, progress and flaunt them to your peers!</p>
		  </div><!-- /.col-lg-4 -->
		  <div class="col-lg-4">
		    <img class="feature-img" src="assets/images/rating.png" alt="Improve your skills" style="  width: 229px; height: auto; margin-bottom: 3rem; margin-top: 3rem;">
		    <h2>Improve your skills</h2>
		    <p>Solve numerous challenges on our platform and compete with your peers to improve and work on your problem solving skills. Discuss and brainstorm hard problems with our growing community.</p>
		  </div><!-- /.col-lg-4 -->
		  <div class="col-lg-4">
		    <img class="feature-img" src="assets/images/analytics.png" alt="progress analytics">
		    <h2>Progress Analytics</h2>
		    <p>Get an overview of your progress and see how you stack up amongst your peers. Our analytics platform will give the deeper insight and suggestions so that you can keep working on improving your skills at your own pace.</p>
             <h4>(Coming Soon!)</h4>
		  </div><!-- /.col-lg-4 -->
		</div><!-- /.row -->
	</section>

   <img class="graph" src="assets/images/graph.png" alt="graph"/>

   <section class="features features-school container-fluid text-center">
		<!-- Three columns of text below the carousel -->
		<div class="row">
           <h2><strong>Gnooble for Schools</strong></h2>
		  <div class="col-lg-4">
		    <img class="feature-img" src="assets/images/code.png" alt="coding platofrm">
		    <h2>Coding Platform</h2>
		    <p>Gnooble is an online platform for colleges and universities as well as employers to host hackathons, code competitions and programming assignments online and grade them remotely.</p>
		  </div><!-- /.col-lg-4 -->
		  <div class="col-lg-4">
		    <img class="feature-img" src="assets/images/progress.png" alt="monitor progress">
		    <h2>Monitor Progress</h2>
		    <p>We collaborate with universities and colleges to host programming assignments and hackathons online. Teachers can monitor each of their student's work, grade and analyze their progress, thereby being able to teach effectively and improving student's skill through practice.</p>
		  </div><!-- /.col-lg-4 -->
		  <div class="col-lg-4">
		    <img class="feature-img" src="assets/images/gear.png" alt="fully automated">
		    <h2>Fully Automated</h2>
		    <p>Run automated public or private programming assignments in the cloud. Add questions, track scores and run competitions at your own convenience.</p>
		  </div><!-- /.col-lg-4 -->
		</div><!-- /.row -->
	</section>

   <footer class="footer text-center">
      <div class="container-fluid">
         <h3>We are still in beta and growing fast.</h3>
         <p>As we're still in beta, you might run into bugs occasionally. Please report any bugs to us immediately using the link below.</p>

         <p>Got any feedback? Suggestions? Criticisms? We wanna hear from you. <a href="mailto:diljitpr@gmail.com">Send us a mail</a></p>

      </div>
      <div class="founders">
         <ul class="text-center list-unstyled list-inline">
            <li>Built by: </li>
            <li><a href="https://www.facebook.com/diljitpr">Diljit</a></li>
            <li><a href="https://www.facebook.com/arshu2kool">Arshad</a></li>
            <li><a href="http://http://sougatanair.com/">Sougata</a></li>
         </ul>
      </div>
   </footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>