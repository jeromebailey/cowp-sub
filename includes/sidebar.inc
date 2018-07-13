<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=base_url('Dashboard/Index')?>" class="site_title"><i class="fa fa-archive"></i> <span title="Inventory & Requisition System">SIR</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <!--<div class="profile_pic">
                <img src="<?=base_url('assets/images/img.jpg');?>" alt="..." class="img-circle profile_img">
              </div>-->
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?//=$this->session->userdata("first_name") . " " .$this->session->userdata("last_name");?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('Dashboard/Index')?>"><i class="fa fa-laptop"></i> Dashboard </a>
                  </li>

                  <?if($this->wp_pal->user_has_permission_to("view_forms")){?>
                    <li><a><i class="fab fa-wpforms"></i> Forms <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">

                        <?if($this->wp_pal->user_has_permission_to("create_flight_check_sheet")){?>
                          <li><a href="<?=base_url('Forms/create_flight_check_sheet');?>">Create Flight Check Sheet</a></li>
                        <?}?>

                        <?if($this->wp_pal->user_has_permission_to("create_invoice")){?>
                          <li><a href="<?=base_url('Forms/create_invoice');?>">Create Invoice</a></li>
                        <?}?>

                        <?if($this->wp_pal->user_has_permission_to("create_purchase_order")){?>
                          <li><a href="<?=base_url('Forms/create_purchase_order');?>">Create Purchase Order</a></li>
                        <?}?>

                        <?if($this->wp_pal->user_has_permission_to("create_requisition")){?>
                          <li><a href="<?=base_url('Forms/create_requisition');?>">Create Product Requisition</a></li>
                        <?}?>

                        <?if($this->wp_pal->user_has_permission_to("create_quote")){?>
                          <li><a href="<?=base_url('Forms/create_quote');?>">Create Quote</a></li>
                        <?}?>                                                
                        
                      </ul>
                    </li>
                  <?}?>

                  <?if($this->wp_pal->user_has_permission_to("view_flight_check_sheets")){?>
                    <li><a href="<?=base_url('FlightCheckSheets/')?>"><i class="fas fa-plane"></i> Flight Check Sheets </a></li>
                  <?}?>

                  <?if($this->wp_pal->user_has_permission_to("view_invoices")){?>
                    <li><a href="<?=base_url('Invoices/')?>"><i class="fas fa-receipt"></i> Invoices </a></li>
                  <?}?>

                  <?if($this->wp_pal->user_has_permission_to("view_quotes")){?>
                    <li><a href="<?=base_url('Quotes/')?>"><i class="fas fa-receipt"></i> Quotes </a></li>
                  <?}?>

                  <?if($this->wp_pal->user_has_permission_to("view_purchase_orders")){?>
                    <li><a href="<?=base_url('PurchaseOrders/')?>"><i class="fas fa-money-bill-alt"></i> Purchase Orders </a></li>
                  <?}?>

                  <?if($this->wp_pal->user_has_permission_to("view_requisitions")){?>
                    <li><a href="<?=base_url('Requisitions/')?>"><i class="fas fa-question"></i> Requisitions </a></li>
                  <?}?>

                  <li><a><i class="fab fa-product-hunt"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Products');?>">Products List</a></li>

                      <?if($this->wp_pal->user_has_permission_to("add_product")){?>
                        <li><a href="<?=base_url('Products/add_product');?>">Add Product</a></li>
                      <?}?>

                      <?if($this->wp_pal->user_has_permission_to("view_generated_barcodes")){?>
                        <li><a href="<?=base_url('Products/list_generated_barcodes');?>">View Generated Product Barcodes</a></li>
                      <?}?>
                      <!--<li><a href="<?=base_url('Products/set_min_stock_level_for_product');?>">Set Product Minimum Stock Level </a></li>-->
                    </ul>
                  </li>

                  <li><a><i class="fas fa-boxes"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Products/inventory_list');?>">View Inventory</a></li>

                      <?if($this->wp_pal->user_has_permission_to("add_inventory")){?>
                        <li><a href="<?=base_url('Products/add_inventory');?>">Add Inventory</a></li>
                      <?}?>
                    </ul>
                  </li>

                  <?if($this->wp_pal->user_has_permission_to("view_suppliers")){?>
                    <li><a><i class="fa fa-user"></i> Suppliers <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?=base_url('Suppliers')?>">All Suppliers</a></li>

                        <?if($this->wp_pal->user_has_permission_to("add_supplier")){?>
                          <li><a href="<?=base_url('Suppliers/add_supplier')?>">Add Supplier</a></li>
                        <?}?> 
                      </ul>
                    </li>
                  <?}?>                 

                </ul>
              </div>

              <?
              if($this->session->userdata("is_an_admin") == 1 ){?>
                <div class="menu_section">
                  <h3>Administrator Menu</h3>
                  <ul class="nav side-menu">
                    <li><a><i class="fa fa-user"></i> Clients <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?=base_url('Clients')?>">All Clients</a></li>
                        <li><a href="<?=base_url('Clients/add_client')?>">Add Client</a></li>
                        <li><a href="<?=base_url('Clients/add_client_flight')?>">Add Client Flight</a></li>
                      </ul>
                    </li>
                    
                    <li><a><i class="fas fa-link"></i> Permissions <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?=base_url('Permissions');?>">Permissions List</a></li>
                        <li><a href="<?=base_url('Permissions/add_permission');?>">Add Permission</a></li>
                      </ul>
                    </li>

                    <li><a href="<?=base_url('Reports/')?>"><i class="fas fa-list-alt"></i> Reports </a></li>
                    
                    <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?=base_url('Users')?>">All Users</a></li>
                        <li><a href="<?=base_url('Users/add_user')?>">Add User</a></li>
                        <li><a href="<?=base_url('Permissions/assign_permission_to_user')?>">Assign Permissions to User</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              <?}?>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
            <!-- /menu footer buttons -->
          </div>
        </div>