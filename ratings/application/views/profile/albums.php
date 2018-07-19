<input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_555") ?>" data-toggle="modal" data-target="#addModal">


<!--Add Album model -->
  <?php echo form_open(site_url("profile/add_album/0")) ?>

 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-picture"></span> <?php echo lang("ctn_555") ?></h4>

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

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>

        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_559") ?>">

      </div>

    </div>

  </div>

</div>

<?php echo form_close() ?>
