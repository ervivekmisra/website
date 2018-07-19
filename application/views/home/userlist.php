    <script type="text/javascript" src="https://surfcloud.com/scripts/custom/profile.js"></script>
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
          <?php if($this->settings->info->enable_rotation_ads_feed) : ?>
          <?php include(APPPATH . "/views/home/rotation_ads.php"); ?>
          <?php endif; ?>
          <a href="http://www.megasurf.com.br" target="_blank"> <img src="../images/adds/banner_adds_members_page.png" style="width: 920px;height: 200px;"></a>
        </div>

      <div class="col-md-10 userlistblock" style="text-align: center;margin-top: 20px;">


        
     
        <?php foreach ($members->result() as $r): ?>
          <div class="col-xs-12 col-sm-6 col-5t userlistphoto" style="text-align: center;padding: 0px;margin-bottom: 10px;">
           <a href="<?php echo site_url("profile/" . $r->username) ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" >
            <h6 style="margin-top: -18px;color:white;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;text-align: center; "><?php echo $r->first_name; ?> <?php echo $r->last_name; ?></h6></a>
            <?php 
            $ci =& get_instance();
            $ci->load->model('User_model');
            $isfriend = $ci->User_model->check_friend($this->user->info->ID,$r->ID);
                         ?>
                         <?php if($isfriend['friend_flag']) : ?>
            <button type="button" style="margin-top: 12px;" class="btn btn-success btn-sm disabled" id="friend_button_<?php echo $r->ID ?>"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_493") ?></button>
            <?php else : ?>
            <?php if($isfriend['request_flag']) : ?>
            <button style="margin-top: 12px;" type="button" class="btn btn-success btn-sm disabled" id="friend_button_<?php echo $r->ID ?>"><?php echo lang("ctn_601") ?></button>
            <?php else : ?> 
              <?php if(!$r->allow_friends) : ?>
                <button type="button" style="margin-top: 12px;" class="btn btn-success btn-sm " onclick="add_friend(<?php echo $r->ID ?>)" id="friend_button_<?php echo $r->ID ?>"><?php echo lang("ctn_602") ?></button>
              <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
           <!-- <button type="button" style="margin-top: 12px;" class="btn btn-success btn-sm" onclick="add_friend(<?php echo $r->ID ?>)" id="friend_button_<?php echo $r->ID ?>"><?php echo lang("ctn_602") ?></button> -->



            
      

			 


          </div>
        <?php endforeach; ?>  
          
        
   		 
      </div>

        
      </div>


<script type="text/javascript">
var global_page = 0;
var hide_prev = 0;



$(document).ready(function() {
  load_posts();

});

function load_posts_wrapper() 
{
  load_posts();
}

<?php if($type == 0) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_home_posts',
    type: 'GET',
    data: {
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      $('#home_posts').jscroll({
        nextSelector : '.load_next'
      });
     
    }
  })
}
<?php elseif($type == 1) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_hashtag_posts',
    type: 'GET',
    data: {
      hashtag : "<?php echo $hashtag ?>",
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      $('#home_posts').jscroll({
          nextSelector : '.load_next'
      });
    }
  })
}
<?php elseif($type == 2) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_saved_posts',
    type: 'GET',
    data: {
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      $('#home_posts').jscroll({
          nextSelector : '.load_next'
      });
    }
  })
}
<?php elseif($type == 3) : ?>
var commentid = <?php echo $commentid ?>;
var replyid = <?php echo $replyid ?>;
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_single_post/<?php echo $postid ?>',
    type: 'GET',
    data: {
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      if(commentid > 0) {
        // Load comment up
        load_single_comment(<?php echo $postid ?>,commentid, replyid);
      }
    }
  })
}
<?php elseif($type == 4) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_all_posts',
    type: 'GET',
    data: {
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      $('#home_posts').jscroll({
          nextSelector : '.load_next'
      });
    }
  })
}
<?php endif; ?>
</script>