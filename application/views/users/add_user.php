<!DOCTYPE html>
<html lang="en">
  <head>
    <?include_once 'includes/head.inc'; ?>
    <link rel="stylesheet" href="<?=base_url('css/jquery-ui.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('css/bootstrapValidator.css');?>">
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <?//include_once 'includes/sidebar.inc'; ?>

        <!-- top navigation -->
        <?//include_once 'includes/topnav.inc'; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="x_content">

            <?include_once 'includes/status_message.inc';?>

            <ol class="breadcrumb">
              <li><a href="<?=base_url('Users');?>">Users</a></li>
              <li class="active">Add User</li>
            </ol>

            <h3><?=$page_title;?> <i class="fas fa-user"></i></h3>

            <form id="add-user-frm" method="post" action="<?=base_url('Users/do_add_user')?>" >

              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is-an-admin">Is an admin? <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="checkbox" id="is-an-admin" name="is-an-admin" >
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-id">User ID <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="user-id" name="user-id" required="" autocomplete="off" class="form-control col-md-7 col-xs-12" placeholder="4858">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="first-name" required autocomplete="off" class="form-control col-md-7 col-xs-12" placeholder="John">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="last-name" name="last-name" required="required" autocomplete="off" class="form-control col-md-7 col-xs-12" placeholder="Jackson">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email-address">Email Address
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="email-address" placeholder="johnjackson@gmail.com" name="email-address" autocomplete="off" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <p>
                        Male:
                        <input type="radio" class="flat" name="gender_id" id="genderM" value="1" checked="" required /> 
                        Female:
                        <input type="radio" class="flat" name="gender_id" id="genderF" value="2" />
                      </p>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email-address">Date of Birth
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="dob" name="dob" autocomplete="off" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email-address">Departments <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="department_id" name="department_id" class="form-control" required="required">
                    <option value="">Select Department</option>
                    <?
                    if( !empty($departments) ){
                      foreach ($departments as $key => $value) {?>
                        <option value="<?=$value["department_id"]?>"><?=$value["department_name"]?></option>
                      <?}
                    } else {

                    }?>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="job-title-id">Job Titles <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="job-title-id" name="job-title-id" class="form-control" required="required">
                    <option value="">Select Job Title</option>
                    <?
                    if( !empty($job_titles) ){
                      foreach ($job_titles as $key => $value) {?>
                        <option value="<?=$value["job_title_id"]?>"><?=$value["job_title"]?></option>
                      <?}
                    } else {

                    }?>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email-address">Password <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="user-password" name="user-password" autocomplete="off" data-minlength="8" required class="form-control col-md-7 col-xs-12">
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email-address">Confirm Password <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="confirm-user-password" name="confirm-user-password" required="required" autocomplete="off" class="form-control col-md-7 col-xs-12" data-match="#user-password" data-match-error="Whoops, these don't match">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-lg btn-success">Submit</button>
                </div>
              </div>

            </form>


          </div>
          <!-- top tiles -->

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?include_once 'includes/footer.inc';?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <?include_once 'includes/scripts.inc';?>
    <script src="<?=base_url('js/bootstrapValidator.js');?>"></script>
    <script src="<?=base_url('js/jquery-ui.min.js');?>"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        $( "#dob" ).datepicker({ 
          dateFormat: 'yy-mm-dd',
          changeYear: true,
          yearRange: "-50:+0" 
        });
          $('#add-user-frm').validator();
    });

    </script>
  </body>
</html>
