<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

#----------------------------------
    function __construct() {
        parent::__construct();
        $this->load->library('Cache');
    }

    public function page_list(){
    	return $result = $this->db->select('news_pages.*,user_info.id,user_info.name')
    	->from('news_pages')
    	->join('user_info','user_info.id=news_pages.publishar_id')
    	->get()
    	->result();
    }
    public function all_page(){
        return $result = $this->db->select('*')
        ->from('news_pages')
        ->get()
        ->result();
    }
    
	public function page_by_id($id){
    	return $result = $this->db->select('*')
    	->from('news_pages')
    	->where('page_id',$id)
    	->get()
    	->row();
	}


}
