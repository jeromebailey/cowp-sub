<!DOCTYPE html>
<html lang="en">
  <head>
    <?include_once 'includes/head.inc' ?>
    <?include_once 'includes/data-table-css.inc' ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <?include_once 'includes/sidebar.inc'; ?>

        <!-- top navigation -->
        <?include_once 'includes/topnav.inc'; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="x_content">
            <h3><?=$page_title;?></h3>

            <div id="page_msg" class="alert "></div>

            <table class="table table-striped table-hover table-bordered" id="data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <!--<th>Middle Name</th>-->
                  <th>Last Name</th>
                  <th>Gender</th>
                  <th>Email Address</th>
                  <th>Department Name</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                <?
                if( empty($all_users) ){?>
                  <tr>
                    <td colspan="7">No data to display</td>
                  </tr>
                <?} else {
                  //echo "<pre>";print_r($all_users);exit;
                  foreach ($all_users as $key => $value) {
                    $encrypted_user_id = urlencode(base64_encode($value["user_id"]));
                    //$encrypted_user_id = $this->encryption->encrypt($value["user_id"]);
                    ?>
                    <tr>
                      <td><?=$value["user_id"];?></td>
                      <td><?=$value["first_name"];?></td>
                      <!--<td><?=$value["middle_name"];?></td>-->
                      <td><?=$value["last_name"];?></td>
                      <td><?=$value["gender"];?></td>
                      <td><?=$value["email_address"];?></td>
                      <td><?=$value["department_name"];?></td>
                      <td><?=$value["status_"];?></td>
                      <td>
                        <a href="" title="Details"><i class="fas fa-file-alt"></i></a> |
                        <a href="<?=base_url('Users/edit_user/'.$encrypted_user_id)?>" title="Edit"><i class="fas fa-edit"></i></a> |
                        <a href="#" onclick="deleteUser('<?=$encrypted_user_id;?>')" title="Delete"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?}
                }
                ?>
              </tbody>
            </table>
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
    <?include_once 'includes/data-table-scripts.inc';?>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#page_msg").hide();
          $('#data-table').DataTable({
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5', 'csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'
            ]
          });
      } );

      function deleteUser(encrypted_id) {

            var do_delete = confirm("Are you sure you want to delete this record?");

            if (do_delete) {
                console.log("id : " + encrypted_id);
                $.post("<?=base_url('Users/delete_user_by_encrypted_id/' );?>" + encrypted_id )
                .done(function (data) {
                    console.log("deleted" + data);
                    if (data === '1') {
                        $("#page_msg").html("User was deleted successfully");
                        $("#page_msg").addClass("alert-success");
                        $("#page_msg").show();
                    } else {
                        $("#page_msg").html("User was NOT deleted");
                        $("#page_msg").addClass("alert-error");
                        $("#page_msg").show();
                    }
                    $("#data-table").load(location.href + " #data-table");
                })
                .fail(function () {
                    console.log("error");
                    $("#page_msg").html("Error occured! User not deleted");
                    $("#page_msg").addClass("alert-error");
                    $("#page_msg").show();
                });
            }
        }

    </script>
  </body>
</html>
