<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('image_model');
	}
	
	public function index(){
		$data['albums']=$this->image_model->get_user_albums_all(4);
		$this->load->view('header',$data);
		$this->load->view('profile/index',$data); 
		$this->load->view('footer',$data);
	}
	public function album($id){
		$page=1;
		$data['images']=$this->image_model->get_album_images($id, $page);
		$this->load->view('header',$data);
		$this->load->view('profile/view_album',$data); 
		$this->load->view('footer',$data);
	}
	public function rate(){
		
		$user_images_id=$this->input->post('user_images_id');
		$rating=$this->input->post('rating');
		$data['images']=$this->image_model->rateImage($user_images_id,$rating);	
		
	}
	public function add_photo($id) 
	{
		$id = intval($id);
		$album = $this->image_model->get_user_album($id);
		if($album->num_rows() == 0) {
			$this->template->error(lang("error_127"));
		}
		$album = $album->row();

		$userid = $album->userid;

		if($userid != $this->user->info->ID) {
			if(!$this->common->has_permissions(array("admin","admin_members"), $this->user)) {
				$this->template->error(lang("error_138"));
			}
		}

		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_85"));
		}
		$user = $user->row();

		$image_url = $this->common->nohtml($this->input->post("image_url"));
		$name = $this->common->nohtml($this->input->post("name"));
		$description = $this->common->nohtml($this->input->post("description"));
		$feed_post = intval($this->input->post("feed_post"));

		$fileid = 0;
		if(!empty($image_url)) {
			 $fileid = $this->image_model->add_image(array(
            	"file_url" => $image_url,
            	"userid" => $this->user->info->ID,
            	"timestamp" => time(),
            	"albumid" => $album->ID,
            	"name" => $name,
            	"description" => $description
            	)
            );
            // Update album count
            $this->image_model->increase_album_count($album->ID);

		} elseif(isset($_FILES['image_file']['size']) && $_FILES['image_file']['size'] > 0) {
			$this->load->library("upload");
			// Upload image
			$this->upload->initialize(array(
			   "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
				)
			);

			if ( ! $this->upload->do_upload('image_file'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->template->jsonError(lang("error_95") . "<br /><br />" .
                    	 $this->upload->display_errors());
            }

            $data = $this->upload->data();

            $fileid = $this->image_model->add_image(array(
            	"file_name" => $data['file_name'],
            	"file_type" => $data['file_type'],
            	"extension" => $data['file_ext'],
            	"file_size" => $data['file_size'],
            	"userid" => $this->user->info->ID,
            	"timestamp" => time(),
            	"albumid" => $album->ID,
            	"name" => $name,
            	"description" => $description
            	)
            );
            // Update album count
            $this->image_model->increase_album_count($album->ID);
		} else {
			$this->template->error(lang("error_129"));
		}

		if($feed_post) {
			// Add a feed post
			$postid = $this->feed_model->add_post(array(
				"userid" => $this->user->info->ID,
				"content" => $description,
				"timestamp" => time(),
				"imageid" => $fileid,
				)
			);
			$this->user_model->increase_posts($this->user->info->ID);
		}

		$this->session->set_flashdata("globalmsg", lang("success_71"));
		redirect(site_url("profile/view_album/" . $id));
	}
}

