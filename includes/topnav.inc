<?
$notifications_for_user = $this->notifications->get_user_notifications_for_drop_down(); //$this->session->userdata('user_id')
$no_of_notifications = count($notifications_for_user);
?>
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <!--<img src="<?=base_url('assets/images/img.jpg');?>" alt="">-->
            <?//=$this->session->userdata("first_name") . " " .$this->session->userdata("last_name");?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="<?=base_url('Users/view_user_profile/'.$this->encryption->encrypt($this->session->userdata('user_id')));?>"> Profile</a></li>
            <li><a href="<?=base_url('Users/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <?
          if($no_of_notifications == 0)
          {?>
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
              <i class="far fa-envelope"></i>
              <span class="badge bg-red">0</span>
            </a>
          <?}
          else
          {?>
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
              <i class="far fa-envelope"></i>
              <span class="badge bg-green"><?=$no_of_notifications;?></span>
            </a>
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <?
            foreach($notifications_for_user as $key => $value)
            {?>
              <li>
                <a href="<?=base_url("Notifications/view_notification/". $value["user_notification_id"] );?>">
                  <span class="image"><img src="<?=base_url('assets/images/img.jpg');?>" alt="Profile Image" /></span>
                  <span>
                    <span>SIR</span>
                    <span class="time"><?=$value["LengthOfTime"];?></span>
                  </span>
                  <span class="message">
                    <?=$value["details"];?>
                  </span>
                </a>
              </li>
            <?}?>
            <li>
              <div class="text-center">
                <a href = "<?=base_url("Notifications");?>">
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </li>
            </ul>
          <?}
          ?>

        </li>
      </ul>
    </nav>
  </div>
</div>