<div class="white-area-content">

    <div class="db-header clearfix">
        <div class="page-header-title">
            <span class="glyphicon glyphicon-bell"></span>
            <?php echo lang("ctn_412") ?>
        </div>
    </div>

    <div>
        <?php foreach($notis as $r) : ?>
        <div class="mail-reply clearfix">
            <div class="mail-reply-avatar">
                <img src="<?php echo site_url("uploads/" . $r["avatar"])?>" class="user-icon">
            </div>
            <div class="mail-reply-body">
                <a href="<?php echo site_url("profile/" . $r["username"])?>"><?php echo $r["username"]?></a> <?php echo $r["message"]?>
                <p class="mail-reply-timestamp"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($r["timestamp"])) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="notification-box-footer">
            <a href="http://surfcloud.com.br/home/notifications">Manage Notifications</a>
        </div>
    </div>
</div>