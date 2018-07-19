<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("feed_model");
		$this->load->model("image_model");
		$this->load->model("page_model");
        $this->load->helper('email');

	}

	public function reset_hashtag() 
	{
		$this->db->update("feed_hashtags", array("count" => 0));
	}

	public function birthday_check()
    {

        $users = $this->user_model->get_members_by_birthday(date("-m-d"));

        if($users->num_rows() > 0) {

            foreach($users->result() as $user)
            {
//                $strB = $user->birthday.format('Y-m-d');
//                echo $user->birthday; exit;
//                echo $user->ID.','."Born on ".$user->birthday; exit;
                $postid = $this->feed_model->add_post(array(
                        "userid" => $user->ID,
                        "content" => "Born on ".$user->birthday,
                        "timestamp" => time(),
                        "template" => "birthday",
                        "hide_profile" => 123
                    )
                );

                if($postid){
                    $friends = $this->user_model->get_friends_ids($user->ID);
                    foreach($friends->result() as $friend) {
                        $this->user_model->increment_field($friend->friendid, "noti_count", 1);
                        $this->user_model->add_notification(array(
                                "userid" => $friend->friendid,
                                "url" => "home/index/3?postid=" . $postid,
                                "timestamp" => time(),
                                "message" => "Born on " . $user->birthday,
                                "status" => 0,
                                "fromid" => $user->ID,//$this->user->info->ID,
                                "username" => $user->username,
                                "email" => $user->email,
                                "email_notification" => $user->email_notification
                            )
                        );
                    }
                    $this->user_model->increment_field($user->ID, "noti_count", 1);
                    $this->user_model->add_notification(array(
                            "userid" => $user->ID,
                            "url" => "home/index/3?postid=" . $postid,
                            "timestamp" => time(),
                            "message" => "Born on ".$user->birthday,
                            "status" => 0,
                            "fromid" => $user->ID,//$this->user->info->ID,
                            "username" => $user->username,
                            "email" => $user->email,
                            "email_notification" => $user->email_notification
                        )
                    );

                }
            }

        }
    }

}

?>