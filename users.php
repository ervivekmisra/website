


<div class="row">

        <div class="col-md-2 sidebar-block" id="homepage-links">
        
        <ul>
        <li <?php if($type == 0) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home") ?>"><span class="glyphicon glyphicon-home" style="color: #4490f6"></span> <?php echo lang("ctn_481") ?></a></li>
        <li><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>"><span class="glyphicon glyphicon-user sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_200") ?></a></li>
        <li><a href="<?php echo site_url("chat") ?>"><span class="glyphicon glyphicon-envelope sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_482") ?></a></li>
        <li><a href="<?php echo site_url("user_settings") ?>"><span class="glyphicon glyphicon-cog sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_156") ?></a></li>
        </ul>

        <p class="sidebar-title"><?php echo lang("ctn_525") ?></p>
        <ul>
        <li><a href="<?php echo site_url("profile/albums/" . $this->user->info->ID) ?>"><span class="glyphicon glyphicon-picture sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_483") ?></a></li>
        <li><a href="<?php echo site_url("pages/your") ?>"><span class="glyphicon glyphicon-duplicate sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_484") ?></a></li>
        <li <?php if($type == 2) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home/index/2") ?>"><span class="glyphicon glyphicon-list-alt sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_485") ?></a></li>
        <?php if($this->settings->info->payment_enabled) : ?>
        <li><a href="<?php echo site_url("funds") ?>"><span class="glyphicon glyphicon-piggy-bank sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_250") ?></a></li>
        <?php endif; ?>
        </ul>
        <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings", "post_admin", "page_admin"), $this->user)) : ?>
          <p class="sidebar-title"><?php echo lang("ctn_35") ?></p>
          <ul>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)) : ?>
        <li><a href="<?php echo site_url("admin") ?>"><span class="glyphicon glyphicon-tower sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_35") ?></a></li>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "post_admin"), $this->user)) : ?>
          <li <?php if($type == 4) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home/index/4") ?>"><span class="glyphicon glyphicon-tower sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_486") ?></a></li>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "page_admin"), $this->user)) : ?>
          <li><a href="<?php echo site_url("pages/all") ?>"><span class="glyphicon glyphicon-tower sidebaricon" style="color: #4490f6"></span> <?php echo lang("ctn_487") ?></a></li>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings", "post_admin", "page_admin"), $this->user)) : ?>
        </ul>
      <?php endif; ?>

        <hr>

        <p class="sidebar-title">
        <?php echo lang("ctn_526") ?></p>
        <ul>
          <?php foreach($hashtags->result() as $r) : ?>
            <li><a href="<?php echo site_url("home/index/1/" . $r->hashtag) ?>">#<?php echo $r->hashtag ?></a></li>
          <?php endforeach; ?>
        </ul>
        </div>

<div class="col-md-10">
<div class="row">

  <div class="jumbotron">
    <h1>Space For ads</h1>
    
  </div>
  <div class="col-md-12">
   <a href="<?php echo site_url('home/test'); ?>" class="btn btn-info btn-xs right-pull" role="button">Alphabetical order</a>
   <a href="<?php echo site_url('home/test/1'); ?>" class="btn btn-info btn-xs right-pull" role="button">Recent Login</a>
   
  </div>
</div>


<?php
$i=0;
foreach($uarr as $user)
{
$id=$user['ID'];
$avatar=$user['avatar'];
$fn=$user["first_name"];
$ln=$user["last_name"];

?>


<div class="gallery">
  <a target="_blank" href="#">
    <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $avatar ?>"    width="300" height="200" />
  </a>
  <div class="desc"><?php echo $fn."&nbsp;".$ln; ?></div>
</div>



<?php
$i++;
$if($i>3)
break;
}
?>
</table>
</div>




<!--col4 start  -->

<!--col4 end  -->
</div>