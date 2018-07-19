<?php

/**
 * This file is part of Photo Selector Download Images plugin. It requires license to use.
 *
 * Admin controller
 * @author flexphperia.net
 */
class Download_images extends CI3_plugin_abstract
{
    /**
     * After how many minutes delete zip files
     * 
     * @var integer 
     */
    private $_delete_zip_after_min = 90; //1,5 hours
    
    /**
     * How many images to pack in one step
     * 
     * @var int 
     */
    private $_step = 14; 
    

    public function __construct()
    {
        parent::__construct();
        
        //load language file
        $lang = $this->CI->config->item('language');
        $this->CI->lang->load(
            'plugin', 
            $lang, 
            false, 
            true, 
            $this->CI->config->item('ps_plugins_path').get_class().DIRECTORY_SEPARATOR); //load langauge non standard files
       
        $page_path = strtolower($this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method());
        
        
        //only if needed
//        if ( $page_path == 'admin/gallery_list' )
//        {
//            add_action('modal_gallery_settings_fieldset_end', [$this, 'modal_gallery_settings_fieldset_end']);
//        }
            
        if ( $page_path == 'admin/gallery' || $page_path == 'main/gallery'  )
        {
            add_action('header', [$this, 'header']);
            add_action('body_end', [$this, 'body_end']);
            
            add_filter('page_gallery_browse_additional_classes', [$this, 'page_gallery_browse_additional_classes']);
            
            add_action('page_gallery_browse_after_sort_dropdown', [$this, 'page_gallery_browse_after_sort_dropdown']);
            add_action('page_gallery_browse_end', [$this, 'page_gallery_browse_end']); 
        }
        
        if ( $page_path == 'admin/gallery_edit'  )
        {
           add_action('gallery_edit_other_fieldset_end', [$this, 'gallery_edit_other_fieldset_end']);
        }
       
        if ( $page_path == 'admin/gallery' || $page_path == 'main/gallery' || $page_path == 'gallery/load_page' )
        {
            add_action('gallery_image_thumb_filename_end', [$this, 'image_filename_end']);
            add_action('gallery_image_filename_end', [$this, 'image_filename_end']);
        }
            
        //load always
        add_filter('validate_gallery_settings_data_keys', [$this, 'validate_gallery_settings_data_keys']);
        add_filter('validate_gallery_settings_data', [$this, 'validate_gallery_settings_data']);
        
        add_action('gallery_vo_constructor_start', [$this, 'gallery_vo_constructor_start']);
        add_action('gallery_vo_constructor_end', [$this, 'gallery_vo_constructor_end']);
    }
   
    public function header()
    {
        ?>
        <link rel="stylesheet" href="<?php echo base_url('plugins/Download_images/css/downloadImagesPlugin.css?v103'); ?>" />
        <?php
    }
    
    public function body_end()
    {
        ?>
        <script src="<?php echo base_url('plugins/Download_images/js/downloadImagesPlugin.js?v103'); ?>" ></script>
        <?php
    }
    
    
    public function validate_gallery_settings_data_keys($needed_keys)
    {
        $needed_keys[] = 'download_enabled';
        return $needed_keys;
    }
    
    public function validate_gallery_settings_data($result, $post_data)
    {
        //if previous result was false then return it
        $result = $result && $this->CI->form_validation->regex_match($post_data['download_enabled'], '/^[0-1]$/');
        return $result;
    }
    
    public function gallery_vo_constructor_start(Gallery_vo $vo)
    {
        //create dynamically additional property in gallery vo constructor, and set default value
        $vo->download_enabled = 0;
    }
    
    
    public function gallery_vo_constructor_end(Gallery_vo $vo)
    {
        //cast to int and make validation here
        $vo->download_enabled = (int)$vo->download_enabled;
    }
    
    
    public function gallery_edit_other_fieldset_end()
    {
        ?>
        <div class="form-group">
        <div class="checkbox" >
            <input id="gsmDownload" type="checkbox" name="download_enabled">
            <label for="gsmDownload"><?php echo lang('admin_modal_gallery_settings_download'); ?></label>
        </div>
        <span class="help-block small"><?php echo lang('admin_modal_gallery_settings_download_help'); ?></span>
        </div>
    <?php                    
        
    }
    
    public function page_gallery_browse_additional_classes($classes, Gallery_vo $gallery_vo)
    {
        if ($gallery_vo->download_enabled)
        {
            $classes .= ' download-enabled';
        }
        return $classes;            
    }

    
    public function page_gallery_browse_after_sort_dropdown(Gallery_vo $gallery_vo)
    {
        //disabled downloading
        if (!$gallery_vo->download_enabled)
        {
            return;
        }
        ?>         
            <div id="downloadDropdown" class="dropdown" >
                <button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php echo lang('gallery_browse_download_dropdown') ?>&nbsp;<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" data-download="all" ><?php echo lang('gallery_browse_download_dropdown_all') ?></a></li>
                    <?php if ($gallery_vo->tagging_enabled || $gallery_vo->commenting_enabled || $gallery_vo->rating_enabled || $gallery_vo->colors_enabled): ?>
                        <li><a href="#" data-download="filter" ><?php echo lang('gallery_browse_download_dropdown_filtered') ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>  
        <?php
    }
    
    public function page_gallery_browse_end(Gallery_vo $gallery_vo)
    {
        //disabled downloading
        if (!$gallery_vo->download_enabled)
        {
            return;
        }
        
        include('views/modal_download.php');         
    }
    
    public function image_filename_end(Gallery_vo $gallery_vo, Image_vo $image_vo = null)
    {
        //disabled downloading
        if (!$gallery_vo->download_enabled)
        {
            return;
        }
        
        ?>
        <button type="button" class="btn btn-xs btn-link" data-download title="<?php echo lang('download_image') ?>" >
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
        </button>
        <?php                    
   
    }
    
    
    public function controller($task)
    {
        if(!in_array ($task, ['single', 'multiple-start', 'multiple-step']))
        {
            return $this->CI->output->json_response(lang('ajax_error_wrong_params'), 2);
        }
        
        $this->CI->load->library('validator');

        //validate that token string is valid
        if ( !$this->CI->validator->validate_gallery_token( $this->CI->input->get('token') ) )
        {
            return $this->CI->output->json_response(lang('ajax_error_wrong_params'), 2);
        }
        
        //check authorization, etc.
        $this->CI->load->model('gallery_model');
        $gallery_vo = $this->CI->gallery_model->get($this->CI->input->get('token'), 'sharing_token');

        $this->CI->load->library('auth');
        //error no gallery vo found, is not admin and not shared so 404
        if ($gallery_vo === false || 
            (!$gallery_vo->sharing_enabled && !$this->CI->auth->admin_logged()) ||
            !$gallery_vo->download_enabled
           )
        {
            return $this->CI->output->json_response(lang('ajax_error_resource_not_found'), 2);
        }

        //check that user is authorized to access for a gallery
        if (!$this->CI->auth->gallery_access_allowed($gallery_vo))
        {
            return $this->output->json_response(lang('ajax_error_refresh'), 3); //not logged in send json response with proper code
        }

        switch($task)
        {
            case 'single':
            {
                $img_path = $this->CI->config->item('ps_storage_path').'images'.
                        DIRECTORY_SEPARATOR.$gallery_vo->id.DIRECTORY_SEPARATOR.
                        basename($this->CI->input->get('filename')); //remove ../ and ./ for security reasons
            
                //check that image exists
                if ( !file_exists($img_path) )
                {
                    redirect('404');
                }
                
                $this->CI->load->model('image_model');                
                $images_vo = $this->CI->image_model->get($gallery_vo->id, basename($this->CI->input->get('filename')));
                
                
                $this->_download_file($img_path, $images_vo->org_filename);
                break;
            }
            case 'multiple-start':
            {
                //validate filter data
                if ( !empty($this->CI->input->get('filter')) && !$this->CI->validator->validate_filter_sort_data( $this->CI->input->get('filter'), null ) )
                {
                    return $this->CI->output->json_response(lang('ajax_error_wrong_params'), 2);
                }
  
                
                $this->_zip_cleanup(); //cleanup old
                
                $this->CI->load->model('image_model');                
                $images_vo = $this->CI->image_model->get($gallery_vo->id, null, new Filter_vo($this->CI->input->get('filter')));
                
                $image_paths = array();
                foreach($images_vo as $image_vo)
                {
                    $image_paths[] = array(
                            'org_filename' => $image_vo->org_filename,
                            'path' => $image_vo->file_path
                            );
                }
                
                $this->CI->load->library('session');
                
                $task_name = $gallery_vo->id.'-'.mt_rand();
                //create if not exists
                if( !isset($_SESSION['download_tasks']) )
                {
                    $_SESSION['download_tasks'] = array();
                }
                
                if (!empty($image_paths)) //only when non empty
                {
                    $_SESSION['download_tasks'][$task_name] = $image_paths;
                }
                
                return $this->CI->output->json_response(empty($image_paths) ? 'no-files' : $task_name); //return okay response
                break;
            }
            case 'multiple-step': //step of creating zip package
            {
                $task_name = $this->CI->input->get('name');
                
                $this->CI->load->library('session');
                
                //if not exists this task
                if( !isset($_SESSION['download_tasks'][$task_name]) )
                {
                    return $this->CI->output->json_response('Download task not exist', 2); //return okay response, changed
                }
                
                $file_paths = $_SESSION['download_tasks'][$task_name];
                $zip_path = $this->CI->config->item('ps_storage_path').'download'.DIRECTORY_SEPARATOR.$task_name.'.zip';
                $zip_exists = file_exists($zip_path);
                
                if (count($file_paths) == 0)
                {
                    //remove task so it may be downloaded only once
                    //to dowload again zip it must be generated from start
                    unset($_SESSION['download_tasks'][$task_name]); 
                    $this->_download_file($zip_path);
                }
                
                $zip = new ZipArchive;
                $res = $zip->open($zip_path, !$zip_exists ? ZipArchive::CREATE : null);
                
                if ($res === true) 
                {
                    //get first step elements
                    $to_pack = array_splice ($file_paths, 0, $this->_step);
                    $_SESSION['download_tasks'][$task_name] = $file_paths; //update session data
                    foreach($to_pack as $file)
                    {
                        //do not use pathinfo, it will not work good on utf names on unix servers
                        $dot_pos = strrpos($file['org_filename'], '.');
                        $ext = substr($file['org_filename'], $dot_pos + 1);
                        $filename = substr($file['org_filename'], 0, $dot_pos);
                        
                        $filename = iconv( 'UTF-8', 'CP852', $filename);
                        
                        //original filenames stored by photo selector are not unique, can be duplicates, so search for duplicates and add suffix to filename
                        while ( $zip->locateName($filename . '.' . $ext) !== false ) //if exists, change name
                        {
                            $filename .= '-duplicate';
                        }                           
                        
                        $zip->addFile($file['path'], $filename.'.'.$ext);
                    }
                    $zip->close();

                    return $this->CI->output->json_response(ceil(count($file_paths) / $this->_step)); 
                } 
                else 
                {
                    return $this->CI->output->json_response('Error operating on ZIP', 2); //return okay response, changed
                }
                break;
            }

            
        }
    }
    
    /**
     * Force file to download
     * 
     * @param string $file_path
     */
    private function _download_file($file_path, $filename = false)
    {
        if (!file_exists($file_path))
        {
            redirect('404');
        }
        
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.($filename? $filename : basename($file_path)).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($file_path));
        ob_end_clean(); //disable output buffer created by Codeigniter
        readfile($file_path);
        exit;
    }
    

    /**
     * Create folder for zip packages
     * 
     * @return type
     */
    public function activate()
    {
        if ( version_compare($this->CI->config->item('ps_version'), '1.05', '<') )
        {
            return 'This plugin requires at least Photo Selector 1.05';
        }
        
        
        return mkdir($this->CI->config->item('ps_storage_path').'download') ? true : 'Cannot create download folder';
    }
    
    /**
     * Remove additional property from galleries storage, delete download folder
     * 
     * @return boolean
     */
    public function deactivate()
    {
        $this->CI->load->model('gallery_model');
        $this->CI->gallery_model->load_storage();
        
        //unset property from galleries.php file
        foreach($this->CI->gallery_model->storage_array as &$gallery_array)
        {
            unset($gallery_array['download_enabled']);
        }
        $this->CI->gallery_model->save_storage();
        
        recursive_delete($this->CI->config->item('ps_storage_path').'download');

        return true;
    }
    
    /**
     * Delete old Zip packages
     */
    private function _zip_cleanup()
    {
        $glob_pattern = $this->CI->config->item('ps_storage_path').
                        'download'.DIRECTORY_SEPARATOR .'*.zip'; 
        
        //find all images
        $zip_file_paths = glob($glob_pattern);
        
        foreach ($zip_file_paths as $file_path)
        {
            $file_time = filemtime($file_path);
            
            //if older than specified minutes then delete it
            if( time() - $file_time >=  60 * $this->_delete_zip_after_min){
                unlink($file_path);
            }
        }
    }
    

       
} 