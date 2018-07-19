<div id="downloadModal" class="modal fade" tabindex="-1" role="dialog"
     data-confirm="<?php echo lang('modal_download_confirm_cancel'); ?>"
     data-progress-title="<?php echo lang('modal_download_preparing'); ?>"
     >
    
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h5><?php echo lang('modal_download_preparing'); ?></h5>
        <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar"  style="min-width: 2em;">0%</div>
        </div>
        <p class="text-danger text-center hide" data-empty><?php echo lang('modal_download_empty'); ?></p>
        <a href="#" class="btn btn-primary btn-sm  hide" data-start-download>
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"> </span>&nbsp;
            <?php echo lang('modal_download_start-download'); ?>
        </a>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-close><?php echo lang('admin_modal_upload_close'); ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->