<?php defined('BASEPATH') or exit('No direct script access allowed');

class Article_controller extends CI_Controller {

    public $default_theme;
#-----------------------------------    
#     Construction Function
#-----------------------------------    
    public function __construct() {
        parent::__construct();
        // loading model
        $this->load->model('Ads');
        $this->load->model("Newssettings");
        $this->load->model('Pb_function', 'pb');
        //$this->load->model("Settings",'settings');
        $this->load->model('Article_model', 'article_model');
        $this->load->model('Page_model', 'ps');
        $this->load->model('News_Home_model', 'hm');
        $this->load->model('Common_model', 'cm');
        $this->load->model('Write_setting_model', 'wsm');
        $this->load->model('comments_model');
        $this->load->model("user_model");
        $this->load->model("page_model");
        $this->template->loadData("activeLink", 
         array("settings" => array("general" => 1)));
    }

#-----------------------------------    
#    Geting news details
#-----------------------------------  
    public function details() {

        $data = $this->article_model->article_select($this->uri->segment(3));

        # ---------------------
        # website setting data   
        $data['enable_rtl']=''; 
        $data['cssincludes']='';  
        $data['content']='';     
        $data['home_page_positions'] = $this->wsm->home_category_position();
        $data['website_logo'] = $this->wsm->website_logo();
        $data['footer_logo'] = $this->wsm->footer_logo();
        $data['website_favicon'] = $this->wsm->website_favicon();
        $data['website_footer'] = $this->wsm->website_footer();
        $data['website_title'] = $this->wsm->website_title();
        $data['website_timezone'] = $this->wsm->website_timezone();
        $data['lan'] = $this->wsm->lan_data();
        $data['default_theme'] = $this->wsm->theme_data();
        $default_theme = $data['default_theme'];

        #----------------------
        $data['mr'] = $this->cm->most_read_dbse();
        $data['ln'] = $this->cm->latest_news();
        $data['bn'] = $this->cm->breaking_news();
        $data['pull'] = $this->cm->pulling();
        $data['Editor'] = $this->hm->home_data('Editor-Choice');
        
        $curr_page = $this->uri->segment(1);
        $data['sn'] = $this->hm->home_data($curr_page);
        $data['seo']['analytics_code'] = $this->Newssettings->get_previous_settings('settings', 5);
        $data['seo']['alexa_code'] = $this->Newssettings->get_previous_settings('settings', 11);
        $data['seo']['social_sites'] = $this->Newssettings->get_previous_settings('settings', 6);
        $data['seo']['fixed_keyword'] = $this->Newssettings->get_previous_settings('settings', 10);
        $data['seo']['comments'] = $this->Newssettings->get_previous_settings('settings', 7);
        $data['social_link'] = $this->Newssettings->get_previous_settings('settings', 111);
        $data['page_view_settings'] = $this->Newssettings->get_previous_settings("settings", 2);
        $data['post_meta'] = $this->pb->get_post_meta_information($this->uri->segment(3));
        $data['time_zone'] = $this->Newssettings->get_previous_settings('settings', 17);

        $data['total_comments'] = $this->comments_model->total_comments($this->uri->segment(3));
        
        $data["comments"] = $this->comments_model->view_data_comments($this->uri->segment(3));

        $data['ads'] = $this->Ads->SelectAds();
        $data['main_menu'] = $this->Newssettings->main_menu();
        $data['menus'] = $this->Newssettings->menu_position_3();
        $data['footer_menu'] = $this->Newssettings->footer_menu();
        
        /*$this->load->view('themes/' . $default_theme . '/header', $data);
        $this->load->view('themes/' . $default_theme . '/breaking');
        $this->load->view('themes/' . $default_theme . '/menu');
        $this->load->view('themes/' . $default_theme . '/article_view');
        $this->load->view('themes/' . $default_theme . '/footer');   */
        $this->template->set_layout("client/themes/newstitan",$data);
        $this->template->loadContent('themes/' . $default_theme . '/article_view',$data);     
        //$this->output->cache(30);
    }
    
}

?>