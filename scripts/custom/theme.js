"use strict";
var header = jQuery('.main_header'),
	header_h = header.height(),
	footer = jQuery('.main_footer'),
	prefooter = jQuery('.prefooter'),
	main_wrapper = jQuery('.main_wrapper'),
	site_wrapper = jQuery('.site_wrapper'),
	nav = jQuery('nav.main_nav'),
	menu = nav.find('ul.menu'),
	html = jQuery('html'),
	body = jQuery('body'),
	myWindow = jQuery(window),
	is_masonry = jQuery('.is_masonry'),
	pp_block = jQuery('.pp_block'),
	fl_container = jQuery('.fl-container'),
	socials_wrapper = jQuery('.socials_wrapper'),
	prImg = [];
if (body.hasClass('admin-bar')) {
	//
}

jQuery(document).ready(function($) {
	if(jQuery('.swipebox').size() > 0) {
		jQuery('html').addClass('gt3_swipe_box');
		jQuery('.swipebox').swipebox({
			afterOpen: function() {
				gt3_setup_soho_box();
			},
			afterClose: function() {
				gt3_close_soho_box();
			}
		});	
	}
	
	if (jQuery('.fadeOnLoad').size() > 0) {
		setTimeout("jQuery('.fadeOnLoad').animate({'opacity' : '1'}, 500)", 500);
	}
	if (body.hasClass('admin-bar') && myWindow.width() > 760) {
		//
	}
	content_update();
	//Flickr Widget
	if (jQuery('.flickr_widget_wrapper').size() > 0) {
		jQuery('.flickr_badge_image a').each(function() {
			jQuery(this).append('<div class="flickr_fadder"></div>');
		});
	}
	//Main and Mobile Menu
	if (header.size() > 0) {
		header.append('<div class="mobile_menu_wrapper"><ul class="mobile_menu container"/></div>');
		jQuery('.mobile_menu').html(nav.find('ul.menu').html());
		jQuery('.mobile_menu_wrapper').hide();
		jQuery('.mobile_menu_toggler').on('click', function() {
			jQuery('.mobile_menu_wrapper').slideToggle(300);
			jQuery('.main_header').toggleClass('opened');
		});
		if (jQuery('.secondary_nav').size() > 0 ){
			jQuery('.mobile_menu').append(jQuery('.secondary_nav .menu').html());
		}
	}
	if (pp_block.size() > 0) {
		html.addClass('pp_page');
	} /* WIDGETS */
	if (jQuery('.widget_search').size() > 0) {
		jQuery('.widget_search').each(function() {
			jQuery(this).find('.search_form').append('<a href="javascript:void(0)" class="widget_search_link_button"></a>');
		});
	} /* FX */
	if (jQuery('.featured_ico').size() > 0) {
		var img_block = jQuery('.img_block');
		img_block.on({
			mouseover: function() {
				jQuery(this).find('.featured_ico').stop().css('left', '47%').animate({
					'left': '50%'
				}, 300);
			},
			mouseout: function() {
				jQuery(this).find('.featured_ico').stop().css('left', '50%').animate({
					'left': '57%'
				}, 300);
			}
		});
	}
	if (jQuery('.no_subtitle').size() > 0) {
		var setTitleMar = (jQuery('.no_subtitle').height() - jQuery('.page_title').height()) / 2;
		jQuery('.page_title').css('transform', 'translateY(' + setTitleMar + 'px)');
	}
	//Comment Form
	if (jQuery('#reply-title').size() > 0) {
		jQuery('#reply-title').wrap('<div class="page_title_wrapper has_subtitle"><div class="page_title page_title_comment_form"></div></div>');
		var subtitle_text = '';
		if (jQuery('.logged-in-as').size() > 0) {
			subtitle_text = jQuery('.logged-in-as').html();
		}
		if (jQuery('.comment-notes').size() > 0) {
			subtitle_text = jQuery('.comment-notes').html();
		}
		jQuery('.page_title_comment_form').append('<h6 class="page_subtitle comment_form_subtitle">' + subtitle_text + '</h6>');
	}
	jQuery('.bg_title').each(function() {
		if (jQuery(this).find('.subtitle').size() > 0) {
			jQuery(this).addClass('with_subtitle');
		}
	});
	if (prefooter.size() > 0 && prefooter.find('.footer_widget').size() < 1) {
		prefooter.addClass('hideme');
	}

	//Grid Gallery
	if (jQuery('.gallery_grid_module').size() >0) {
		var gt3_setPad = jQuery('.gallery_grid_module').attr('data-setpad');
		jQuery('.gallery_grid_module').css({'padding-top' : gt3_setPad, 'margin-left' : gt3_setPad});
		
		jQuery('.gallery_grid_content').each(function(){
			var gt3_setPad = jQuery(this).attr('data-setpad');
			jQuery(this).css({'padding-right' : gt3_setPad, 'margin-bottom' : gt3_setPad});
		});
		
		jQuery('.gallery_grid_item').each(function(){
			jQuery(this).css('width', jQuery(this).attr('data-item-width')+'%');
		});
	}
	//Pages BG
	if (jQuery('.fw_background.bg_image').size() > 0) {
		jQuery('.fw_background.bg_image').css('background-image', 'url('+ jQuery('.fw_background.bg_image').attr('data-bg')+')');
	}
	if (jQuery('.fw_background.bg_color').size() > 0) {
		jQuery('.fw_background.bg_color').css('background-color', '#'+jQuery('.fw_background.bg_color').attr('data-bgcolor'));
	}
	//Count Icons BG
	if (jQuery('.count_ico').size() > 0) {
		jQuery('.count_ico').each(function(){
			jQuery(this).css({
				'color' : '#'+jQuery(this).attr('data-color'),
				'background-color' : '#'+jQuery(this).attr('data-bgcolor'),
			});
		});
	}
	//HP Featured Image
	if (jQuery('.hp_featured_image').size() > 0) {
		jQuery('.hp_featured_image').css('background-image', 'url('+ jQuery('.hp_featured_image').attr('data-bg')+')');
	}
	
    // P R E L O A D E R //
    if (jQuery('.preloader').size() > 0) {
        //setTimeout("jQuery('.preloader').addClass('start_preloader')",500); //DEBUG ANIMATION
		if (jQuery('.fs_preloader').size() > 0) {
			setTimeout('preImg(fsImg)', 300);
		} else {
			jQuery('.img2preload').each(function () {
				prImg.push(jQuery(this).attr('src'));
			});
			jQuery('.block2preload').each(function () {
				prImg.push(jQuery(this).attr('data-src'));
			});
			setTimeout('preImg(prImg)', 300);
		}
    }	
    
    // Contact form
	if (jQuery('.contact_form').size() > 0) {
		jQuery("#ajax-contact-form").on('submit', function() {
			var str = $(this).serialize();		
			$.ajax({
				type: "POST",
				url: "contact_form/contact_process.php",
				data: str,
				success: function(msg) {
					// Message Sent - Show the 'Thank You' message and hide the form
					if(msg == 'OK') {
						var result = '<div class="notification_ok">Your message has been sent. Thank you!</div>';
						jQuery("#fields").hide();
					} else {
						var result = msg;
					}
					jQuery('#note').html(result);
				}
			});
			return false;
		});
	}	
});

jQuery(document).on("click", ".widget_search_link_button", function(event) {
	jQuery(this).parent('.search_form').submit();
});

function preImg(imgArray) {
    if (imgArray.length > 0) {
        var perStep = 100 / imgArray.length,
            percent = 0,
			cur_step = 1,
            line1 = jQuery('.preloader_line_bar1'),
            line2 = jQuery('.preloader_line_bar2');
	        //console.log(imgArray.length +';'+perStep+';'+perStep*imgArray.length); //DEBUG SCRIPT
        for (var i = 0; i < imgArray.length; i++) {
			
            (function (img, src) {
                img.onload = function () {
                    percent = (cur_step * perStep) / 2;
                    //console.log('PerStep:'+ perStep +' ; ' + percent + '% loaded'); //DEBUG SCRIPT
                    //console.log(img + ' loaded.'); //DEBUG SCRIPT
                    line1.css('width', percent + '%');
                    line2.css('width', percent + '%');
                    if (percent >= 50) {
                        removePreloader();
                    }
					cur_step ++;
                };
                img.src = src;
            }(new Image(), imgArray[i]));
        }
    } else {
        setTimeout("removePreloader()", 500);
    }
}

function removePreloader() {
    setTimeout("jQuery('.preloader').addClass('removePreloader')", 450);
	setTimeout("jQuery('.preloader').addClass('openPreloader')", 750);
    setTimeout("jQuery('.preloader').remove()", 1300);
	if (jQuery('.fs_gallery_trigger').size() > 0) {
		setTimeout("run_fs_slider()", 750);
	}
}
jQuery(window).resize(function() {
	content_update();
	if(jQuery('.swipebox').size() > 0) {
		if (jQuery.swipebox.isOpen ) {
			gt3_setup_soho_box();
			setTimeout("gt3_setup_soho_box()",500);
		}
	}	
});

jQuery(window).load(function() {
	content_update();
});

;
(function($) {
    
    // Page Share
    if (jQuery('.page_share').size() > 0) {
        jQuery('.page_share').on('click',function(){
            jQuery('.fs_share_block').removeClass('fs_share_hided');
        });
        jQuery('.fs_share_fadder').on('click',function(){
            jQuery('.fs_share_block').addClass('fs_share_hided');
        });
        jQuery(document.documentElement).keyup(function (event) {
            if (!jQuery('.fs_share_block').hasClass('fs_share_hided') && event.keyCode == 27) {
                jQuery('.fs_share_block').addClass('fs_share_hided');
            }
        });								
    }
    
    // Shortcode counter
    if (jQuery('.shortcode_counter').size() > 0) {
        if (myWindow.width() > 760) {						
            jQuery('.shortcode_counter').each(function(){							
                if (jQuery(this).offset().top < myWindow.height()) {
                    if (!jQuery(this).hasClass('done')) {
                        var set_count = jQuery(this).find('.stat_count').attr('data-count');
                        jQuery(this).find('.stat_temp').stop().animate({width: set_count}, {duration: 3000, step: function(now) {
                                var data = Math.floor(now);
                                jQuery(this).parents('.counter_wrapper').find('.stat_count').html(data);
                            }
                        });	
                        jQuery(this).addClass('done');
                        jQuery(this).find('.stat_count');
                    }							
                } else {
                    jQuery(this).waypoint(function(){
                        if (!jQuery(this).hasClass('done')) {
                            var set_count = jQuery(this).find('.stat_count').attr('data-count');
                            jQuery(this).find('.stat_temp').stop().animate({width: set_count}, {duration: 3000, step: function(now) {												
                                    var data = Math.floor(now);
                                    jQuery(this).parents('.counter_wrapper').find('.stat_count').html(data);
                                }
                            });	
                            jQuery(this).addClass('done');
                            jQuery(this).find('.stat_count');
                        }
                    },{offset: 'bottom-in-view'});								
                }														
            });
        } else {
            jQuery('.shortcode_counter').each(function(){							
                var set_count = jQuery(this).find('.stat_count').attr('data-count');
                jQuery(this).find('.stat_temp').animate({width: set_count}, {duration: 3000, step: function(now) {
                        var data = Math.floor(now);
                        jQuery(this).parents('.counter_wrapper').find('.stat_count').html(data);
                }
                });
                jQuery(this).find('.stat_count');
            },{offset: 'bottom-in-view'});	
        }
    }
    
    // Accordion & Toggle
    if (jQuery('.module_accordion').size() > 0 || jQuery('.module_toggle').size() > 0) {
        jQuery('.shortcode_accordion_item_title').on('click',function(){
            if (!jQuery(this).hasClass('state-active')) {
                jQuery(this).parents('.shortcode_accordion_shortcode').find('.shortcode_accordion_item_body').slideUp('fast',function(){
                    content_update();
                });
                jQuery(this).next().slideToggle('fast',function(){
                    content_update();
                });
                jQuery(this).parents('.shortcode_accordion_shortcode').find('.state-active').removeClass('state-active');
                jQuery(this).addClass('state-active');
            }
        });
        jQuery('.shortcode_toggles_item_title').on('click',function(){
            jQuery(this).next().slideToggle('fast',function(){
                content_update();
            });
            jQuery(this).toggleClass('state-active');
        });

        jQuery('.shortcode_accordion_item_title.expanded_yes, .shortcode_toggles_item_title.expanded_yes').each(function( index ) {
            jQuery(this).next().slideDown('fast',function(){
                content_update();
            });
            jQuery(this).addClass('state-active');
        });
    }
    
    // Instagram
    if (jQuery('#instagram_module').size() > 0) {
        if (jQuery('.instagram_module_title').size() > 0) {
            var item_count = 6;
            jQuery('#instagram_module').addClass('with_margin');
        } else {
            var item_count = 7;
        }
        var feed = new Instafeed({
            get: 'user',
            userId: 2272331954, //  Unique id of a user
            accessToken: '2272331954.3a81a9f.c5dfe123bbdc4f469edfd95f975dde90', // A valid oAuth token
            target: 'instagram_module',
            resolution: 'low_resolution',
            limit: item_count,
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /></a>'
        });
        feed.run();
    }
    
    // Tabs
    if (jQuery('.shortcode_tabs').size() > 0) {
        jQuery('.shortcode_tabs').each(function(index) {
            /* GET ALL HEADERS */
            var i = 1;
            jQuery(this).find('.shortcode_tab_item_title').each(function(index) {
                jQuery(this).addClass('it'+i); jQuery(this).attr('whatopen', 'body'+i);
                jQuery(this).addClass('head'+i);
                jQuery(this).parents('.shortcode_tabs').find('.all_heads_cont').append(this);
                i++;
            });

            /* GET ALL BODY */
            var i = 1;
            jQuery(this).find('.shortcode_tab_item_body').each(function(index) {
                jQuery(this).addClass('body'+i);
                jQuery(this).addClass('it'+i);
                jQuery(this).parents('.shortcode_tabs').find('.all_body_cont').append(this);
                i++;
            });

            /* OPEN ON START */
            jQuery(this).find('.expand_yes').addClass('active');
            var whatopenOnStart = jQuery(this).find('.expand_yes').attr('whatopen');
            jQuery(this).find('.'+whatopenOnStart).addClass('active');
        });

        jQuery(document).on('click', '.shortcode_tab_item_title', function(){
            jQuery(this).parents('.shortcode_tabs').find('.shortcode_tab_item_body').removeClass('active');
            jQuery(this).parents('.shortcode_tabs').find('.shortcode_tab_item_title').removeClass('active');
            var whatopen = jQuery(this).attr('whatopen');
            jQuery(this).parents('.shortcode_tabs').find('.'+whatopen).addClass('active');
            jQuery(this).addClass('active');
            content_update();
        });
    }
    
    // Skills
    if (jQuery('.shortcode_diagramm_shortcode').size() > 0) {
        if (myWindow.width() > 760) {
            jQuery('.skill_li').waypoint(function(){
                jQuery('.skill_bar').each(function(){
                    jQuery(this).css('width', jQuery(this).attr('data-width')+'%');
                });
            },{offset: 'bottom-in-view'});
        } else {
            jQuery('.skill_bar').each(function(){
                jQuery(this).css('width', jQuery(this).attr('data-width')+'%');
            });
        }
    }
    
    // Messagebox
    if (jQuery('.shortcode_messagebox').size() > 0) {
        jQuery('.shortcode_messagebox').find('.btn_box_close').on('click',function(){
            jQuery(this).parents('.module_messageboxes').fadeOut(400);
        });
    }
    
    // nivoSlider
    if (jQuery('.nivoSlider').size() > 0) {
        jQuery('.nivoSlider').each(function(){
            jQuery(this).nivoSlider({
                directionNav: true,
                controlNav: false,
                effect:'fade',
                pauseTime:4000,
                slices: 1
            });
        });
    }
    
})(jQuery);		

function content_update() {
	if (jQuery('.sticky_on').size() > 0) {
		jQuery('.header_holder').height(header.height());
	}
	if (myWindow.width() > 760) {
		if (body.hasClass('admin-bar')) {}
	}
	if (jQuery('.hp_content_wrapper').size() > 0) {
		if (jQuery('#wpadminbar').size() > 0) {
			var setTop = parseInt(jQuery('.hp_content_wrapper').css('padding-top')) + jQuery('#wpadminbar').height();
			var setHeight = myWindow.height() - parseInt(jQuery('.hp_content_wrapper').css('padding-top')) - parseInt(jQuery('.hp_content_wrapper').css('padding-bottom')) - jQuery('#wpadminbar').height();
		} else {
			var setTop = parseInt(jQuery('.hp_content_wrapper').css('padding-top'));
			var setHeight = myWindow.height() - parseInt(jQuery('.hp_content_wrapper').css('padding-top')) - parseInt(jQuery('.hp_content_wrapper').css('padding-bottom'));
		}
		jQuery('.hp_featured_image').css('top', setTop + 'px').height(setHeight);
	}
	if (jQuery('.frame16x9').size() > 0) {
		iframe16x9(jQuery('.frame16x9'));
	}
}

function animateList() {
	jQuery('.loading:first').removeClass('loading').animate({
		'z-index': '15'
	}, 150, function() {
		animateList();
		if (is_masonry.size() > 0) {
			is_masonry.masonry();
		}
	});
};

function scrolling() {
	if (jQuery('.fullscreen_blog').size() > 0) {
		var target = jQuery('.fullscreen_blog');
	} else if (jQuery('.fw_grid_gallery').size() > 0) {
		var target = jQuery('.fw_grid_gallery');
	} else {
		var target = jQuery('body');
	}
	var chk_height = target.height() - jQuery(this).height() - header.height() - 100;
	if (jQuery(this).scrollTop() >= chk_height) {
		jQuery(this).unbind("scroll");
		get_works();
	}
}

function iframe16x9(frame_class) {
	frame_class.each(function() {
		jQuery(this).height((jQuery(this).width() / 16) * 9);
	});
}
var setTop = 0;

function gt3_open_soho_box() {
}

function gt3_setup_soho_box() {
	var swipe_slider = jQuery('#swipebox-slider'),
		swipe_title = jQuery('#swipebox-top-bar'),
		swipe_bottom = jQuery('#swipebox-bottom-bar'),
		setHeight = 0;
	setHeight = jQuery(window).height() - swipe_title.height() - swipe_bottom.height();
	swipe_slider.height(setHeight).css('top', swipe_title.height());
}

function gt3_close_soho_box() {
}
jQuery(document).on("click", "#swipebox-container .slide.current img", function (e) {	
	jQuery('#swipebox-next').click();
	e.stopPropagation();
});
jQuery(document).on("click", "#swipebox-container", function (e) {
	jQuery('#swipebox-close').click();
});