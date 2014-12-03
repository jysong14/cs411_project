<nav class="navbar navbar-fixed-top" id="header" role="navigation">
	<ul class="nav navbar-nav navbar-left">
        <li><a href="<?php echo URL.'board/recruiterBoard'; ?>">Recruiter Board</a></li>
    </ul>             
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo URL.'setting'; ?>"><?php echo Session::get("username");?></a></li>
		<li><a href="<?php echo URL.'index/logout'; ?>">Logout</a></li>
    </ul>

</nav>
<?php $user = $this->userInfo; ?>
<?php $company = $this->companyInfo; ?>

<div class="row" id="content">    
    <div class="col-lg-3">
        <h3>Hello, <?php echo $user['firstname']; ?></h3>
        <ul>
            <li>email: <?php echo $user['email']?></li>
            <li>first name: <?php echo $user['firstname']?></li>
            <li>last name: <?php echo $user['lastname']?></li>
            <li>personal link: <a href="<?php echo $user['personalLink']?>"><?php echo $user['personalLink']?></a></li>
        </ul>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Job Posting</button>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Job Posting</h4>
                </div>
                <div class="modal-body">
                        <div class="container">
                            <h2>Post a Job Here</h2>
                            <p>Try to fill in all information. It will help you to find most suitable applicant</p>
                                <form role="form" id = "jobpost">
                                    <!--<div class="form-group">-->
                                    <div class="col-lg-8" id="jobcompany">
                                        <label for="jobcompany">Company: </label>
                                        <p>
                                            <?php
                                                if(strcmp($company, '') == 0){
                                                    echo "Please edit your profile to add company name!";
                                                }
                                                else{
                                                    echo $company;
                                                }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-8" id="jobtitle">
                                        <label for="jobtitle">Job Title: </label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="jobtype">
                                        <label for="jobtype">Job Type:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="jobarea">
                                        <label for="jobarea">Job Area/Field:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="joblevel">
                                        <label for="joblevel">Experience Level:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="joblocation">
                                        <label for="joblocation">Office Location:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="jobsalary">
                                        <label for="joblocation">Avg Salary:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="jobvisa">
                                        <label for="jobvisa">Visa Sponsorship:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <div class="col-lg-8" id="jobdescription">
                                        <label for="jobdescription">Job Description:</label>
                                        <input type="text" class="form-control" required="required">
                                    </div>
                                    <!--</div>-->
                                </form>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addJobPost">Add Posting</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6" id="accountSettings">
        <?php
	    if (isset($this->data) || !empty($this->data)) {
                echo '<table id="job-container"><tbody id="job-body">';
                foreach ($this->data as $info) {
                    echo '<tr>'
                        . '<td>'
                            . '<a class="job-title" id="'. $info['jobID'] .'" data-toggle="modal" data-target="#jobModal" onclick="updateJob(\''.$info['jobID'].'\',  \''.$info['title'].'\')"><h4>'. $info['title'] . '</h4></a>' 
                            . '<div>' . $info['companyName'] . ' - ' . $info['location'] . '</div>'
                            . '<div class="job-description">'. $info['description'] . '</div>' 
                            . '<div>'. $info['postedDate'] . '</div>' 
                            . '<div class="jobID">JobID: '. $info['jobID'] . '</div>'
                        . '</td>'
                        .'</tr>';
                }
                echo '</tbody></table>';
            }
        ?>
    </div>
    
    <!-- Job-Student Modal -->
    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <div id="job-modal-title">
                        <h4 class="modal-title" id="myModalJobTitleLabel">Job Title</h4>
                        &nbsp;&nbsp;<a class="process-set-tag" data-toggle="modal" data-target="#setJobProcessModal" onclick="changeJobProcessBody('<?php echo $info['jobID']; ?>', '<?php echo Session::get('userId'); ?>')">Set Process</a>
                    </div>
                </div>
                <div class="modal-body" id="jobModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Set Job Process Modal -->
    <div class="modal fade" id="setJobProcessModal" tabindex="-1" role="dialog" aria-labelledby="setJobProcessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="setJobProcessLabel">Set Job Process</h4>
                </div>
                <div class="modal-body" id="setJobProcessBody">
                    <form method="post" id="job-process-setting-form">
                        <input type="checkbox" name="on_campus" value="on_campus" id="on_campus"/><label for="on_campus">On Campus</label>
                        <input type="checkbox" name="phonescreen1" value="phonescreen1" id="phonescreen1"/><label for="phonescreen1">Phone Screen I</label>
                        <input type="checkbox" name="phonescreen2" value="phonescreen2" id="phonescreen2"/><label for="phonescreen2">Phone Screen II</label>
                        <input type="checkbox" name="phonescreen3" value="phonescreen3" id="phonescreen3"/><label for="phonescreen3">Phone Screen III</label>
                        <input type="checkbox" name="phonescreen4" value="phonescreen4" id="phonescreen4"/><label for="phonescreen4">Phone Screen IV</label>
                        <input type="checkbox" name="on_site" value="on_site" id="on_site"/><label for="on_site">On Site</label>
                        <input type="hidden" name="jobId" id="set-process-jobId" value="" />
                        <input type="hidden" name="recruiterId" id="set-process-recruiterId" value="" /><br /><br />
                        <input class="btn btn-default" id="post-submit" data-dismiss="modal" type="submit" value="Save changes"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- PDF viewer modal -->
    <div class="modal fade" id="pdfViewModal" tabindex="-1" role="dialog" aria-labelledby="pdfViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalJobTitleLabel">PDF Viewer</h4>
                </div>
                <div class="modal-body" id="pdfViewModalBody">
                    <object data="<?php echo URL.'public/resume/test.pdf'; ?>" type="application/pdf" width="570" height="750"> 
                        <div>Your Browser is not supporting HTML5 -- you cannot see pdf file in your browser</div>
                        <div><a href="<?php echo URL.'public/resume/test.pdf'; ?>">Resume</a></div>
                    </object>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

