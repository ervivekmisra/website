<div class="row">
 <div class="col-md-12">


 <div class="profile-header" style="background: url(<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $user->profile_header ?>) center center; background-size: cover;">
 <div class="profile-header-avatar">
	<img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
 </div>
 <div class="profile-header-name">
<?php echo $user->first_name ?> <?php echo $user->last_name ?>
 </div>
 </div>
 <div class="profile-header-bar clearfix">
 <ul>
 	<li><a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo lang("ctn_200") ?></a></li>
 	<li><a href="<?php echo site_url("profile/friends/" . $user->ID) ?>"><?php echo lang("ctn_493") ?></a></li>
 	<li class="active"><a href="<?php echo site_url("profile/albums/" . $user->ID) ?>">Photos</a></li>
 </ul>

 <div class="pull-right profile-friend-box">
  <?php if($user->ID != $this->user->info->ID) : ?>
      <button type="button" class="btn btn-success btn-sm" onclick="chat_with(<?php echo $user->ID ?>)" id="chat_button_<?php echo $user->ID ?>"><?php echo lang("ctn_459") ?></button>

      <?php if($friend_flag) : ?>
<button type="button" class="btn btn-success btn-sm" id="friend_button_<?php echo $user->ID ?>"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_493") ?></button>
<?php else : ?>
<?php if($request_flag) : ?>
<button type="button" class="btn btn-success btn-sm disabled" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_601") ?></button>
<?php else : ?>
  <?php if(!$user->allow_friends) : ?>
  <button type="button" class="btn btn-success btn-sm" onclick="add_friend(<?php echo $user->ID ?>)" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_602") ?></button>
  <?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
 </div>
 </div>

<div class="white-area-content separator">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> My Photos</div>
    <div class="db-header-extra form-inline"> 

        <div class="form-group has-feedback no-margin">

<?php if($user->ID == $this->user->info->ID) : ?>
    <?php //if($album->userid == $this->user->info->ID || $this->common->has_permissions(array("admin","admin_members"), $this->user)) : ?>
        <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_581") ?>" data-toggle="modal" data-target="#addModal">
        <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_582") ?>" data-toggle="modal" data-target="#addMultiModal">
    <?php //endif; ?>

<?php endif; ?>
</div>
</div>


    <hr>

    <?php if($images->num_rows() == 0) : ?>
        <p><?php echo lang("ctn_583") ?> <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal"><?php echo lang("ctn_584") ?></a> <?php echo lang("ctn_585") ?></p>
    <?php else : ?>
        <div>
            <ul class="album-images">
                <?php foreach($images->result() as $r) : ?>
                    <li class="album-image all_album_list">
                        <?php if(isset($r->file_name)) : ?>
                            <img class="album_big_img" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->file_name ?>" width="140" alt="<?php echo $r->name . "<br>" . $r->description ?>">
                        <?php else : ?>.
                            <img class="album_big_img" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/default_album.png" width="140" alt="<?php echo $r->name . "<br>" . $r->description ?>">
                        <?php endif; ?>
                        <div class="album_overlay"></div>
                        <div class="album_inner">
                            <div class="album_content_wrapper">
                                <p><?php echo $r->name ?></p>
                                <?php if($album->userid == $this->user->info->ID || $this->common->has_permissions(array("admin","admin_members"), $this->user)) : ?>
                                    <div class="album-image-options">
                                        <a href="javascript:void(0)" onclick="edit_image(<?php echo $r->ID ?>)" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> <a href="<?php echo site_url("profile/delete_image/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($r->file_name)) : ?>
                                    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->file_name ?>" width="40" alt="<?php echo $r->name . "<br>" . $r->description ?>">
                                <?php else : ?>
                                    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/default_album.png" width="40" alt="<?php echo $r->name . "<br>" . $r->description ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="align-center">
        <?php echo $this->pagination->create_links() ?>
    </div>


</div>

 </div>
</div>
    <?php
    echo $album->userid.", ".$this->user->info->ID;
    ?>
<?php if($album->userid == $this->user->info->ID || $this->common->has_permissions(array("admin","admin_members"), $this->user)) : ?>

    <?php echo form_open_multipart(site_url("profile/albums/" . $album->userid), array("ID"=>"form_addphoto")) ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-picture"></span> <?php echo lang("ctn_586") ?></h4>
                </div>
                <div class="modal-body ui-front form-horizontal">
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_81") ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_271") ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_556") ?></label>
                        <div class="col-md-8">
                            <?php echo $album->name ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_499") ?></label>
                        <div class="col-md-8">
                                <input type="file" class="form-control" name="image_file" id="fileupload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_500") ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="image_url" placeholder="http://www ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_574") ?></label>
                        <div class="col-md-8">
                            <input type="checkbox" class="form-control" name="feed_post" value="1" checked>
                            <span class="help-area"><?php echo lang("ctn_587") ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="progressbar">
                            <div id="progress_value"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>

                    <input type="button" id="btnupload" class="btn btn-primary" value="<?php echo lang("ctn_584") ?>">

                </div>
            </div>

        </div>
    </div>
    <?php echo form_close() ?>
    <?php echo form_open_multipart(site_url("profile/albums/" . $album->userid), array("ID"=>"form_refresh_albums")) ?>
    <?php echo form_close() ?>
    <div class="modal1" id="alert-modal">
        <div class="modal-content1">
            <input type="button" id="btn_alert_close" class="btn btn-default" value="Close">
            <input type="button" id="btn_alert_ok" class="btn btn-primary" value="OK">

            <h4 class = "h3_lavel"><label id="alert_message"></label></h4>
        </div>
    </div>


    <?php echo form_open_multipart(site_url("profile/add_multi_photo/" . $album->ID), array("id"=>"form_addphoto_multi")) ?>
    <div class="modal fade" id="addMultiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-picture"></span> <?php echo lang("ctn_588") ?></h4>
                </div>
                <div class="modal-body ui-front form-horizontal">
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_556") ?></label>
                        <div class="col-md-8">
                            <?php echo $album->name ?>
                        </div>
                    </div>
                    <div id="multi">
                        <div class="form-group">
                            <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_499") ?></label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="image_file_1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_500") ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="image_url_1" placeholder="http://www ...">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="amount" name="amount" value="1">
                    <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_589") ?>" onclick="add_photo()">

                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_574") ?></label>
                        <div class="col-md-8">
                            <input type="checkbox" class="form-control" name="feed_post" value="1" checked>
                            <span class="help-area"><?php echo lang("ctn_587") ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="progressbar_multi">
                            <div id="progress_value_multi"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
                    <input type="button" id="btnupload_multi"  class="btn btn-primary" value="<?php echo lang("ctn_584") ?>">
                </div>
            </div>

        </div>


    </div>
    <?php echo form_close() ?>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="edit-album">

            </div>
        </div>
    </div>
<?php endif; ?>


<script type="text/javascript">

    function add_photo()
    {
        var id = parseInt($('#amount').val());
        id = id + 1;
        $('#amount').val(id);

        var html = '<div class="form-group">'
            +'<label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_499") ?> '+id+'</label>'
            +'<div class="col-md-8">'
            +'<input type="file" class="form-control" name="image_file_'+id+'">'
            +'</div>'
            +'</div>'
            +'<div class="form-group">'
            +'<label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_500") ?> '+id+'</label>'
            +'<div class="col-md-8">'
            +'<input type="text" class="form-control" name="image_url_'+id+'" placeholder="http://www ...">'
            +'</div>'
            +'</div>';
        $('#multi').append(html);
    }
    $(document).ready(function() {
        var alert_modal = document.querySelector("#alert-modal");

//        var closeButton = document.querySelector(".close-button");

        function toggleModal() {
            alert_modal.classList.toggle("show-modal1");
        }

        function windowOnClick(event) {
            if (event.target === alert_modal) {
                toggleModal();
//                $("#form_refresh_albums").submit();
            }
        }
        $("#btn_alert_close").click(function(e){
            toggleModal();
        });
        $("#btn_alert_ok").click(function(e){
            toggleModal();
            window.location.href = "<?php echo (site_url("profile/albums/" . $album->userid)) ?>";
        });


//        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);


        $("#alert-modal").bind('hide', function(){
            window.location.href = "<?php echo (site_url("profile/albums/" . $album->userid)) ?>";
        })

        $("#btnupload").click(function (e) {

            $("#progressbar").css("display", "block");

            $("#form_addphoto").submit();
        });

        $('#form_addphoto').submit(function (e) {
           var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '<?php echo (site_url("profile/add_photo/" . $album->ID)) ?>',
                data: formData,
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', progress, false);
                    }
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    console.log('upload success', data);
                    $("#alert_message").text("Image upload Success.");
//                    alert('data returned successfully');

                    toggleModal();

                },

                error: function (data) {
                    console.log(data);
                    $("#alert_message").text("Image upload fail.");
                    toggleModal();
                }
            });

            e.preventDefault();

        });


        $("#btnupload_multi").click(function (e) {

            $("#progressbar_multi").css("display", "block");

            $("#form_addphoto_multi").submit();
        });


        $('#form_addphoto_multi').submit(function (e) {

            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '<?php echo (site_url("profile/add_multi_photo/" . $album->ID)) ?>',
                data: formData,
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', progress_multi, false);
                    }
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    console.log('upload success', data);
                    $("#alert_message").text("Images upload Success.");
                    toggleModal();

                },

                error: function (data) {
                    console.log(data);
                    $("#alert_message").text("Images upload fail.");
                    toggleModal();
                }
            });

            e.preventDefault();

        });
    });


        function progress(e){

            if(e.lengthComputable){
                var max = e.total;
                var current = e.loaded;

                var Percentage = (current * 100)/max;
                console.log(e);
                $("#progress_value").css("width", Percentage+"%");


                if(Percentage >= 100)
                {
                    // process completed
                }
            }
        }

    function progress_multi(e){

        if(e.lengthComputable){
            var max = e.total;
            var current = e.loaded;

            var Percentage = (current * 100)/max;
            console.log("efewfwefe", e);
            $("#progress_value_multi").css("width", Percentage+"%");


            if(Percentage >= 100)
            {
                // process completed
            }
        }
    }


</script>