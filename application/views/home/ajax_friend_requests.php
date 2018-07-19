<?php if($friend_requests->num_rows() > 0) : ?>
<?php foreach($friend_requests->result() as $r) : ?>
<div class="notification-box-bit animation-fade clearfix ">
  <div class="notification-icon-bit">
    <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" class="user-icon">
  </div>
  <div class="projects-text-bit small-text">
    <a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a> <?php echo $r->username .  " " . lang("ctn_660") ?>
    <p class="notification-datestamp"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($r->online_timestamp)) ?></p>
  </div>
    <div class="div_friendaction">
        <a href="<?php echo site_url("user_settings/friend_request/1/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-success btn-xs">
            <?php echo lang("ctn_623") ?></a>
        <a href="<?php echo site_url("user_settings/friend_request/0/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs">
            <?php echo lang("ctn_624") ?></a>
    </div>
</div>
<?php endforeach; ?>
<?php else : ?>
<p><?php echo lang("ctn_411") ?></p>
<?php endif; ?>
