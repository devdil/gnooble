<?php

include '../../includes/Authenticate.php';
include '../../classes/student.php';

  Authenticate::preventUnauthorisedLogin();

 $queryResult = Student::getQuestionsSolved($_SESSION['userid']);
 $queryUserDetails = Student::getUserDetails($_SESSION['userid']);

include '../../views/template_header.php';
?>
		  <h1 class="page-header">Settings</h1>
         <p class="lead">Edit profile and settings</p>

		   <div class="row">
              <div role="tabpanel">

                 <!-- Nav tabs -->
                 <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#personal" aria-controls="Personal Details" role="tab" data-toggle="tab">Personal Details</a></li>
                    <li role="presentation"><a href="#password" aria-controls="Password" role="tab" data-toggle="tab">Password</a></li>
                 </ul>

                 <!-- Tab panes -->
                 <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="personal">
                       <form method="POST" enctype="multipart/form-data" class="col-md-6 col-xs-6">
                          <div class="form-group">
                             <label for="fullname">Full Name</label>
                             <input type="text" class="form-control" id="fullname" placeholder="What's your full name?">
                          </div>
                          <div class="form-group">
                             <label for="emailaddr">Email Address</label>
                             <input type="email" class="form-control" id="emailaddr" placeholder="What's your email address?">
                          </div>
                          <div class="form-group">
                             <label for="contact">Contact Number</label>
                             <input type="tel" class="form-control" id="contact" placeholder="What's your contact number?">
                          </div>
                          <div class="form-group">
                             <label for="input-dept">Department</label>
                             <div>
                                <select required name="department" id="input-dept" class="form-control">
                                   <option value="CSE">Computer Science</option>
                                   <option value="EE">Electrical Engineering</option>
                                   <option value="ECE">Electronics Engineering</option>
                                   <option value="IT">Information Technology</option>
                                   <option value="FT">Food Technology</option>
                                </select>
                             </div>
                          </div>
                          <div class="form-group">
                             <label for="photo">Upload Profile Picture</label>
                             <input type="file" id="photo">
                          </div>
                          <button type="submit" class="btn pull-right btn-success">Save Changes</button>
                       </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="password">
                       <form action="" method="POST" class="col-md-6 col-xs-6">
                          <div class="form-group">
                             <label for="currpass">Current Password</label>
                             <input required name="currpass" type="password" class="form-control" id="currpass" placeholder="Put your current password">
                          </div>
                          <div class="form-group">
                             <label for="newpass">New Password</label>
                             <input required name="newpass" type="password" class="form-control" id="newpass" placeholder="Put the new password">
                          </div>
                          <div class="form-group">
                             <label for="verifypass">Verify Password</label>
                             <input required name="verifypass" type="password" class="form-control" id="verifypass" placeholder="Verify the new password">
                          </div>

                          <button type="submit" class="btn pull-right btn-success">Change Password</button>
                       </form>
                    </div>
                 </div>

              </div>
		   </div>

<?php
include '../../views/template_footer.php';
?>