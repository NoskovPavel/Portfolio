<?php
/*
Plugin Name: Image Zoom
Plugin Tag: zoom, highslide, image, panorama
Description: <p>Allow to dynamically zoom on images in posts/pages/... </p><p>When clicked, the image will dynamically scale-up. Please note that you have to insert image normally with the wordpress embedded editor.</p><p>You may configure:</p><ul><li>The max width/height of the image; </li><li>The transition delay; </li><li>The position of the buttons; </li><li>The auto-start of the slideshow; </li><li>the opacity of the background; </li><li>the pages to be excluded. </li></ul><p>If the image does not scale-up, please verify that the HTML looks like the following : &lt;a href=' '&gt;&lt;img src=' '&gt;&lt;/a&gt;.</p><p>This plugin implements the colorbox javascript library. </p><p>This plugin is under GPL licence.</p>
Version: 1.8.8
Author: SedLex
Author Email: sedlex@sedlex.fr
Framework Email: sedlex@sedlex.fr
Author URI: http://www.sedlex.fr/
Plugin URI: http://wordpress.org/plugins/image-zoom/
License: GPL3
*/


require_once('core.php') ; 

class imagezoom extends pluginSedLex {
	/** ====================================================================================================================================================
	* Initialisation du plugin
	* 
	* @return void
	*/
	static $instance = false;
	var $path = false;
	
	var $image_type ;

	protected function _init() {
		global $wpdb ; 
		// Configuration
		$this->pluginName = 'Image Zoom' ; 
		$this->tableSQL = "" ; 
		$this->table_name = $wpdb->prefix . "pluginSL_" . get_class() ; 
		
		$this->path = __FILE__ ; 
		$this->pluginID = get_class() ; 
		
		//Init et des-init
		register_activation_hook(__FILE__, array($this,'install'));
		register_deactivation_hook(__FILE__, array($this,'deactivate'));
		register_uninstall_hook(__FILE__, array('imagezoom','uninstall'));
		
		//Parametres supplementaires		
		$this->image_type = "(bmp|gif|jpeg|jpg|png)" ;
		
	}
	
	/**
	 * Function to instantiate our class and make it a singleton
	 */
	 
	public static function getInstance() {
		if ( !self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/** ====================================================================================================================================================
	* In order to uninstall the plugin, few things are to be done ... 
	* (do not modify this function)
	* 
	* @return void
	*/
	
	public function uninstall_removedata () {
		global $wpdb ;
		// DELETE OPTIONS
		delete_option('imagezoom'.'_options') ;
		if (is_multisite()) {
			delete_site_option('imagezoom'.'_options') ;
		}
		
		// DELETE SQL
		if (function_exists('is_multisite') && is_multisite()){
			$old_blog = $wpdb->blogid;
			$old_prefix = $wpdb->prefix ; 
			// Get all blog ids
			$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM ".$wpdb->blogs));
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				$wpdb->query("DROP TABLE ".str_replace($old_prefix, $wpdb->prefix, $wpdb->prefix . "pluginSL_" . 'imagezoom')) ; 
			}
			switch_to_blog($old_blog);
		} else {
			$wpdb->query("DROP TABLE ".$wpdb->prefix . "pluginSL_" . 'imagezoom' ) ; 
		}
		
		// DELETE FILES if needed
		//SLFramework_Utils::rm_rec(WP_CONTENT_DIR."/sedlex/favicon/"); 
		$plugins_all = 	get_plugins() ; 
		$nb_SL = 0 ; 	
		foreach($plugins_all as $url => $pa) {
			$info = pluginSedlex::get_plugins_data(WP_PLUGIN_DIR."/".$url);
			if ($info['Framework_Email']=="sedlex@sedlex.fr"){
				$nb_SL++ ; 
			}
		}
		if ($nb_SL==1) {
			SLFramework_Utils::rm_rec(WP_CONTENT_DIR."/sedlex/"); 
		}
	}	


	/** ====================================================================================================================================================
	* Define the default option value of the plugin
	* 
	* @return variant of the option
	*/
	function get_default_option($option) {
		switch ($option) {
			case 'widthRestriction'		 	: return 1200 	; break ; 
			case 'heightRestriction'		: return 1200 	; break ; 

			case 'mobile_restriction'		 	: return false 	; break ; 
			case 'widthRestriction_mobile'		 	: return 800 	; break ; 
			case 'heightRestriction_mobile'		: return 800 	; break ; 
			
			case 'show_interval'		 	: return 5000 	; break ; 
			case 'show_alt'		 			: return false 	; break ; 
			case 'show_title'		 		: return false 	; break ; 
			case 'background_opacity'		: return "0.8" ; break ; 
			case 'slideshow_autostart'		: return false ; break ; 
			case 'disable_nav_buttons'		: return false ; break ; 
			case 'disable_next_on_click'		: return false ; break ; 
			case 'disable_slide_buttons'	: return false ; break ; 
			case 'tra_image'		: return "Image {current} of {total}" ; break ; 
			case 'tra_previous'		: return "Previous" ; break ; 
			case 'tra_next'			: return "Next" ; break ; 
			case 'tra_close'		: return "Close" ; break ; 
			case 'tra_play'			: return "Play" ; break ; 
			case 'tra_pause'		: return "Pause" ; break ; 
			case 'exclu'		: return "*" ; break ; 
			
			case 'css'		: return "*.gallery_colorbox {}
#cboxOverlay{}
#colorbox{}
#cboxContent{}
.cboxIframe{}
#cboxError{}
#cboxLoadedContent{}
#cboxTitle{}
#cboxTitle h2{}
#cboxCurrent{}
#cboxLoadingGraphic{}
#cboxLoadingOverlay{}
#cboxLoadingGraphic{}
#cboxLoadedContent{}
#cboxPrevious, #cboxNext, #cboxSlideshow, #cboxClose {}
#cboxPrevious:active, #cboxNext:active, #cboxSlideshow:active, #cboxClose:active {}
#cboxPrevious{}
#cboxPrevious:hover{}
#cboxNext{}
#cboxClose{}
#cboxClose:hover{}
.cboxSlideshow_off #cboxSlideshow{}
.cboxSlideshow_off #cboxSlideshow:hover{}
.cboxSlideshow_on #cboxSlideshow{}
.cboxSlideshow_on #cboxSlideshow:hover{}" ; break ; 
			
			case 'disable_mobile' : return false ; break ; 
			
			case 'image_clip'	: return true ; break ; 

			case 'theme'		: return array(		array("*".__("Theme 01", $this->pluginID), "th01"), 
											array(__("Theme 02", $this->pluginID), "th02"),											
											array(__("Theme 03", $this->pluginID), "th03"),
											array(__("Theme 04", $this->pluginID), "th04")
									   ) ; break ; 
		}
		return null ;
	}
	
	/**====================================================================================================================================================
	* Function called when the plugin is activated
	* For instance, you can do stuff regarding the update of the format of the database if needed
	* If you do not need this function, you may delete it.
	*
	* @return void
	*/
	
	public function _update() {
		$theme = $this->get_param('theme') ; 
		$is_theme4 = false ; 
		foreach ($theme as $val) {
			if ($val[1]=="th04") {
				$is_theme4 = true ; 
			}
		}
		if (!$is_theme4) {
			$theme = array_merge($theme, array(array(__("Theme 04", $this->pluginID), "th04"))) ; 
		}
		$this->set_param('theme', $theme) ; 
	}
	

	/** ====================================================================================================================================================
	* Init javascript for the public side
	* If you want to load a script, please type :
	* 	<code>wp_enqueue_script( 'jsapi', 'https://www.google.com/jsapi');</code> or 
	*	<code>wp_enqueue_script('my_plugin_script', plugins_url('/script.js', __FILE__));</code>
	*	<code>$this->add_inline_js($js_text);</code>
	*	<code>$this->add_js($js_url_file);</code>
	*
	* @return void
	*/
	
	function _public_js_load() {	
		wp_enqueue_script('jquery');   
		
		// We check whether there is an exclusion
		$exclu = $this->get_param('exclu') ;
		$exclu = explode("\n", $exclu) ;
		foreach ($exclu as $e) {
			$e = trim(str_replace("\r", "", $e)) ; 
			if ($e!="") {
				$e = "@".$e."@i"; 
				if (preg_match($e, $_SERVER['REQUEST_URI'])) {
					return ; 
				}
			}
		}
		
		if ((wp_is_mobile())&&($this->get_param('disable_mobile'))) {
			return ; 
		}
	
		ob_start() ; 
		?>
		jQuery(document).ready(function () {	
		
			jQuery(window).resize(function () { 
				jQuery('a.gallery_colorbox').colorbox({
				<?php
					if ((!$this->get_param('mobile_restriction'))||(!wp_is_mobile())) {
				?>
					maxWidth: Math.min(<?php echo $this->get_param('widthRestriction') ; ?>, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(<?php echo $this->get_param('heightRestriction') ; ?>, Math.floor(0.95*jQuery(window).height())-80)
				<?php
					} else {
				?>
					maxWidth: Math.min(<?php echo $this->get_param('widthRestriction_mobile') ; ?>, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(<?php echo $this->get_param('heightRestriction_mobile') ; ?>, Math.floor(0.95*jQuery(window).height())-80)
				<?php
					
					}
				?>

				}) ; 
			});
				
			jQuery('a.gallery_colorbox').colorbox({ 
				slideshow: true,
				<?php if (($this->get_param('show_alt'))&&(!$this->get_param('show_title'))) { ?>
				title: function(){ 
					if (typeof jQuery(this).children("img:first").attr('alt') !== "undefined") {
						return jQuery(this).children("img:first").attr('alt'); 
					} else {
						return "" ; 
					}
				},
				<?php } else if ((!$this->get_param('show_alt'))&&($this->get_param('show_title'))) { ?>
				title: function(){ 
					if (typeof jQuery(this).children("img:first").attr('title') !== "undefined") {
						return "<h2>"+jQuery(this).children("img:first").attr('title')+"</h2>" ; 
					} else {
						return "" ; 
					}
				},
				<?php } else if (($this->get_param('show_alt'))&&($this->get_param('show_title'))) { ?>
				title: function(){ 
					var out = "" ; 
					if (typeof jQuery(this).children("img:first").attr('title') !== "undefined") {
						out = out + "<h2>"+jQuery(this).children("img:first").attr('title')+"</h2>" ; 
					} else {
						out = out + "" ; 
					}
					if (typeof jQuery(this).children("img:first").attr('alt') !== "undefined") {
						out = out + jQuery(this).children("img:first").attr('alt'); 
					} else {
						out = out + "" ; 
					}
					return out; 
				},
				<?php 				
				} else {
				?>
				title: false,
				<?php }
				if ($this->get_param('slideshow_autostart')) { ?>
				slideshowAuto:true,
				<?php } else { ?>
				slideshowAuto:false,
				<?php } ?>
				slideshowSpeed: <?php echo $this->get_param('show_interval');?> ,
				slideshowStart: '<?php echo $this->get_param('tra_play') ; ?>',
				slideshowStop :  '<?php echo $this->get_param('tra_pause') ; ?>',
				current : '<?php echo $this->get_param('tra_image') ; ?>', 
				scalePhotos : true , 
				previous: '<?php echo $this->get_param('tra_previous') ; ?>',	
				next:'<?php echo $this->get_param('tra_next') ; ?>',
				close:'<?php echo $this->get_param('tra_close') ; ?>',
				<?php 
				if ($this->get_param('image_clip')) { ?>
				<?php
					if ((!$this->get_param('mobile_restriction'))||(!wp_is_mobile())) {
				?>
					maxWidth: Math.min(<?php echo $this->get_param('widthRestriction') ; ?>, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(<?php echo $this->get_param('heightRestriction') ; ?>, Math.floor(0.95*jQuery(window).height())-80),
				<?php
					} else {
				?>
					maxWidth: Math.min(<?php echo $this->get_param('widthRestriction_mobile') ; ?>, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(<?php echo $this->get_param('heightRestriction_mobile') ; ?>, Math.floor(0.95*jQuery(window).height())-80),
				<?php
					}
				} else { ?>
				<?php
					if ((!$this->get_param('mobile_restriction'))||(!wp_is_mobile())) {
				?>
					maxWidth: <?php echo $this->get_param('widthRestriction') ; ?>, 
					maxHeight: <?php echo $this->get_param('heightRestriction') ; ?>,
				<?php
					} else {
				?>
					maxWidth: <?php echo $this->get_param('widthRestriction_mobile') ; ?>, 
					maxHeight: <?php echo $this->get_param('heightRestriction_mobile') ; ?>,
				<?php
					}
				}
				?>
								
				
				opacity:<?php echo $this->get_param('background_opacity');?> , 
				onComplete : function(){ 
					jQuery("#cboxLoadedContent").css({overflow:'hidden'});
					jQuery("#colorbox").css({overflow:'visible'});
				<?php
				if ($this->get_param('disable_nav_buttons')) {
				?>
					jQuery("#cboxPrevious").hide();
					jQuery("#cboxNext").hide();
				<?php
				}
				if ($this->get_param('disable_next_on_click')) {
				?>
    				jQuery('.cboxPhoto').unbind().click(jQuery('a.gallery_colorbox').colorbox.close); 
				<?php
				}
				if ($this->get_param('disable_slide_buttons')) {
				?>
					jQuery("#cboxSlideshow").hide();
				<?php
				}
				?>
				},
				rel:'group1' 
			});
		});	
						
		<?php 
		$content = ob_get_clean() ; 
		$this->add_inline_js($content) ; 
	}
	
	
	/** ====================================================================================================================================================
	* Init css for the public side
	* If you want to load a style sheet, please type :
	*	<code>$this->add_inline_css($css_text);</code>
	*	<code>$this->add_css($css_url_file);</code>
	*
	* @return void
	*/
	
	function _public_css_load() {	
		// We check whether there is an exclusion
		$exclu = $this->get_param('exclu') ;
		$exclu = explode("\n", $exclu) ;
		foreach ($exclu as $e) {
			$e = trim(str_replace("\r", "", $e)) ; 
			if ($e!="") {
				$e = "@".$e."@i"; 
				if (preg_match($e, $_SERVER['REQUEST_URI'])) {
					return ; 
				}
			}
		}
		
		$theme = $this->get_param('theme') ; 
		foreach ($theme as $t) {
			if (substr($t[0], 0, 1) == "*") {
				if ($t[1]=="th01") {
					$this->add_css(plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme1.css") ; 
				}
				if ($t[1]=="th02") {
					$this->add_css(plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme2.css") ; 
				}
				if ($t[1]=="th03") {
					$this->add_css(plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme3.css") ; 
				}
				if ($t[1]=="th04") {
					$this->add_css(plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme4.css") ; 
				}
			}
		}
		
		$this->add_inline_css($this->get_param('css')) ; 

	}

	/** ====================================================================================================================================================
	* Called when the content is displayed
	*
	* @param string $content the content which will be displayed
	* @param string $type the type of the article (e.g. post, page, custom_type1, etc.)
	* @param boolean $excerpt if the display is performed during the loop
	* @return string the new content
	*/
	
	function _modify_content($string, $type, $excerpt) {	
		// We check whether there is an exclusion
		$exclu = $this->get_param('exclu') ;
		$exclu = explode("\n", $exclu) ;
		foreach ($exclu as $e) {
			$e = trim(str_replace("\r", "", $e)) ; 
			if ($e!="") {
				$e = "@".$e."@i"; 
				if (preg_match($e, $_SERVER['REQUEST_URI'])) {
					return $string ; 
				}
			}
		}
				
		$pattern = '/(<a([^>]*?)href=["\']([^"\']*)["\']([^>]*?)>((?:[^<]|<br)*)<img([^>]*?)src=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>([^<]|<br)*<\/a>)/iu';
		$out = preg_replace_callback($pattern, array($this,"_modify_content_callback"), $string);
		
		return $out ; 
	}
	
	/** ====================================================================================================================================================
	* Called when the content is displayed
	*
	* @param string $content the content which will be displayed
	* @param string $type the type of the article (e.g. post, page, custom_type1, etc.)
	* @param boolean $excerpt if the display is performed during the loop
	* @return string the new content
	*/
	
	function _modify_content_callback($matches) {
  		// comme d'habitude : $matches[0] represente la valeur totale
  		// $matches[1] represente la première parenthèse capturante
		
		// On regarde si on doit ne pas le traiter
		if (strpos($matches[0],"exclude_image_zoom")!==false) {
			return $matches[0];
		}

		$pattern_img = '/(<a([^>]*?)href=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>((?:[^<]|<br)*)<img([^>]*?)src=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>((?:[^<]|<br)*?)<\/a>)/isU';
  		
		if (preg_match($pattern_img, $matches[0])) {
			return preg_replace_callback($pattern_img, array($this, "_modify_content_callback2"), $matches[0]);
		}
		
		$id_attach = url_to_postid($matches[3]) ; 
		if (($id_attach!=0)&&(wp_attachment_is_image($id_attach))) {
			// Remove existing class in this link
			$matches[0] = preg_replace("/<a([^>]*?)class='[^']*'([^>]*?)>/u","<a$1$2>",$matches[0]) ; 
			$matches[0] = preg_replace('/<a([^>]*?)class="[^"]*"([^>]*?)>/u',"<a$1$2>",$matches[0]) ; 
			
			$pattern = '/(<a([^>]*?)href=["\']([^"\']*)["\']([^>]*?)>((?:[^<]|<br)*?)<img([^>]*?)src=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>((?:[^<]|<br)*?)<\/a>)/isU';
  			$image = wp_get_attachment_image_src( $id_attach , 'full');
  			
  			$this->image_temp = $image ; 
			
			return preg_replace_callback($pattern, array($this, "_modify_content_callback3"), $matches[0]);
		}
		
  		return $matches[0];
	}
	
  	function _modify_content_callback2 ($m) {
  		return stripslashes("<a".$m[2]."href=\"".$m[3]."".$m[4]."\" class=\"gallery_colorbox\"".$m[5].">".$m[6]."<img".$m[7]."src=\"".$m[8]."".$m[9]."\" ".$m[10].">".$m[11]."</a>");
	}
	
	function _modify_content_callback3 ($m) {
		return stripslashes("<a".$m[2]."href=\"".$this->image_temp[0]."\" class=\"gallery_colorbox\"".$m[4].">".$m[5]."<img".$m[6]."src=\"".$m[7]."".$m[8]."\" ".$m[9].">".$m[10]."</a>") ; 
	}
	
	
	/** ====================================================================================================================================================
	* The configuration page
	* 
	* @return void
	*/
	function configuration_page() {
		global $wpdb;
	
		?>
		<div class="plugin-titleSL">
			<h2><?php echo $this->pluginName ?></h2>
		</div>
		
		<div class="plugin-contentSL">		
			<?php echo $this->signature ; ?>
			
			<!--debut de personnalisation-->
		<?php
		
			// On verifie que les droits sont corrects
			$this->check_folder_rights( array() ) ; 	
			
			// On verifie que le header.php du theme ne contient pas de jquery
			
			$header = @file_get_contents(TEMPLATEPATH."/header.php") ; 
			
			if (preg_match("/jquery/i", $header)) {
				echo "<div class='error fade'><p>".sprintf(__("Your theme contains (i.e. in %s file) a hardcoded reference to the jQuery javascript library.", $this->pluginID), "<code>".TEMPLATEPATH."/header.php</code>")."</p><p>".sprintf(__("This reference may break the plugin. So, if the plugin does not work, please either delete this reference or move it just after the %s declaration.", $this->pluginID), "<code>&lt;head&gt;</code>")."</p></div>" ; 
			}
			
			//==========================================================================================
			//
			// Mise en place du systeme d'onglet
			//		(bien mettre a jour les liens contenu dans les <li> qui suivent)
			//
			//==========================================================================================
			
			
			$tabs = new SLFramework_Tabs() ; 
			ob_start() ; 
				$params = new SLFramework_Parameters($this, 'tab-parameters') ; 
				$params->add_title(__('What are the clipped dimensions of the zoomed image?',$this->pluginID)) ; 
				$params->add_param('widthRestriction', __('Max width:',$this->pluginID)) ; 
				$params->add_param('heightRestriction', __('Max height:',$this->pluginID)) ; 
				$params->add_param('image_clip', __('Do you want to clip to browser size:',$this->pluginID)) ; 
				$params->add_param('mobile_restriction', __('Do you want other width/height for mobile terminals?',$this->pluginID), "", "", array("widthRestriction_mobile", "heightRestriction_mobile")) ; 
				$params->add_param('widthRestriction_mobile', __('Max width for mobile:',$this->pluginID)) ; 
				$params->add_param('heightRestriction_mobile', __('Max height for mobile:',$this->pluginID)) ; 
				
				$params->add_title(__('What is the text for the frontend?',$this->pluginID)) ; 
				$params->add_param('tra_previous', __('Previous:',$this->pluginID)) ; 
				$params->add_param('tra_next', __('Next:',$this->pluginID)) ; 
				$params->add_param('tra_close', __('Close:',$this->pluginID)) ; 
				$params->add_param('tra_play', __('Play:',$this->pluginID)) ; 
				$params->add_param('tra_pause', __('Pause:',$this->pluginID)) ; 
				$params->add_param('tra_image', __('The image counter:',$this->pluginID)) ; 
				$params->add_comment(sprintf(__('The %s will be replace with the index of the image and %s with the total number of images in the page.',$this->pluginID), "<code>{current}</code>", "<code>{total}</code>")) ; 
				
				$params->add_title(__('What is the theme?',$this->pluginID)) ; 
				$params->add_param('theme', __('Choose the theme:',$this->pluginID)) ; 
				$params->add_comment(sprintf(__('Theme 01 is : %s.',$this->pluginID), "<img src='".plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme1_illustr.jpg"."'/>")) ; 
				$params->add_comment(sprintf(__('Theme 02 is : %s.',$this->pluginID), "<img src='".plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme2_illustr.jpg"."'/>")) ; 
				$params->add_comment(sprintf(__('Theme 03 is : %s.',$this->pluginID), "<img src='".plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme3_illustr.jpg"."'/>")) ; 
				$params->add_comment(sprintf(__('Theme 04 is : %s (created by %s).',$this->pluginID), "<img src='".plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme4_illustr.jpg"."'/>", "Andreas Amundin")) ; 
				$params->add_param('css', __('Additional CSS you want to add:',$this->pluginID)) ; 
				$params->add_comment(__('If you want to modify sligthly the CSS, you can modify it here.',$this->pluginID)) ; 
				$params->add_comment_default_value('css') ; 

				$params->add_title(__('Show description text',$this->pluginID)) ; 
				$params->add_param('show_title', __('Show the title of the image:',$this->pluginID)) ; 
				$params->add_param('show_alt', __('Show the alternative text of the image:',$this->pluginID)) ; 
				
				$params->add_title(__('What are the other parameters?',$this->pluginID)) ; 
				$params->add_param('show_interval', __('Transition time if the slideshow is on:',$this->pluginID)) ; 
				$params->add_param('slideshow_autostart', __('Auto-start the slideshow when launched:',$this->pluginID)) ; 
				$params->add_param('background_opacity', __('The opacity of the background:',$this->pluginID)) ; 
				
				$params->add_title(__('Advanced parameters?',$this->pluginID)) ; 
				$params->add_param('disable_nav_buttons', __('Disable the navigation buttons on images:',$this->pluginID)) ; 
				$params->add_param('disable_next_on_click', __('Disable click on the image for next (it will then close the slideshow):',$this->pluginID)) ; 
				$params->add_param('disable_slide_buttons', __('Disable the slideshow buttons on images:',$this->pluginID)) ; 
				
				$params->add_param('exclu', __('List of page exclusions (regular expressions):',$this->pluginID)) ; 
				$params->add_comment(sprintf(__('For instance, you may exclude page with URL like %s by setting this option to %s. Please add one regular expressions by line',$this->pluginID), "<code>http://yourdomain.tld/portfolio/</code>", "<code>portfolio</code>")) ; 
				$params->add_comment(sprintf(__('You may also exclude this same page by setting this option to %s',$this->pluginID), "<code>http://www\\.yourdomain\\.tld/portfolio/</code>")) ; 
				$params->add_comment(sprintf(__('In addition, you may set this option to %s and to %s to exclude the home page',$this->pluginID), "<code>^/$</code>", "<code>^$</code>")) ; 
				
				$params->add_param('disable_mobile', __('Disable if the user uses mobile terminal:',$this->pluginID)) ; 
				
				$params->flush() ; 
			$tabs->add_tab(__('Parameters',  $this->pluginID), ob_get_clean() , plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_param.png") ; 	

			// HOW To
			ob_start() ;
				echo "<p>".__('This plugin allows a dynamic zoom on the images.', $this->pluginID)."</p>" ; 
				echo "<p>".sprintf(__('All images in your pages/posts like %s will be zoomable.', $this->pluginID),"<code>&lt;a href=''&gt;&lt;img src=''&gt;&lt;/a&gt;</code>")."</p>" ; 
			$howto1 = new SLFramework_Box (__("Purpose of that plugin", $this->pluginID), ob_get_clean()) ; 
			ob_start() ;
				echo "<p>".sprintf(__('If you want to exclude one specific image, please modify the HTML code so that this image is like that: %s or %s.', $this->pluginID),"<code>&lt;a href='' class='exclude_image_zoom'&gt;&lt;img src=''&gt;&lt;/a&gt;</code>","<code>&lt;a href=''&gt;&lt;img src='' class='exclude_image_zoom'&gt;&lt;/a&gt;</code>")."</p>" ; 
			$howto2 = new SLFramework_Box (__("Exclude an image", $this->pluginID), ob_get_clean()) ; 
			ob_start() ;
				echo "<p>".__('If you want to exclude one specific page, please use the advanced option in the configuration tab', $this->pluginID)."</p>" ; 
				echo "<p>".sprintf(__('For instance, you may exclude page with URL like %s by setting this option to portfolio. Please add one regular expressions by line.', $this->pluginID), "<code>http://yourdomain.tld/portfolio/</code>")."</p>" ; 
				echo "<p>".sprintf(__('You may also exclude this same page by setting this option to %s.', $this->pluginID), "<code>http://www\.yourdomain\.tld/portfolio/</code>")."</p>" ; 
				echo "<p>".sprintf(__('In addition, you may set this option to %s and to %s to exclude the home page.', $this->pluginID), "<code>^/$</code>", "<code>^$</code>")."</p>" ; 
			$howto3 = new SLFramework_Box (__("Exclude a page", $this->pluginID), ob_get_clean()) ; 
			ob_start() ;
				echo "<p>".__('One of the most probable reason that the plugin does not work is that there is a conflict with your theme of one of your plugins.', $this->pluginID)."</p>" ; 
				echo "<p>".__('Before contacting me, please test deactivating each plugin one by one to see if it solve the problem and change the theme by the default one.', $this->pluginID)."</p>" ; 
				echo "<p>".sprintf(__('Indeed, most of the time the %s library is not loaded correctly.', $this->pluginID), "<code>jQuery</code>")."</p>" ;
				echo "<p>".__('I cannot give you a simple way to correct it!', $this->pluginID)."</p>" ; 
			$howto4 = new SLFramework_Box (__("The plugin does not work", $this->pluginID), ob_get_clean()) ; 
			ob_start() ;
				 echo $howto1->flush() ; 
				 echo $howto2->flush() ; 
				 echo $howto3->flush() ; 
				 echo $howto4->flush() ; 
			$tabs->add_tab(__('How To',  $this->pluginID), ob_get_clean() , plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_how.png") ; 	
					
			ob_start() ; 
				$plugin = str_replace("/","",str_replace(basename(__FILE__),"",plugin_basename( __FILE__))) ; 
				$trans = new SLFramework_Translation($this->pluginID, $plugin) ; 
				$trans->enable_translation() ; 
			$tabs->add_tab(__('Manage translations',  $this->pluginID), ob_get_clean() , plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_trad.png") ; 	

			ob_start() ; 
				$plugin = str_replace("/","",str_replace(basename(__FILE__),"",plugin_basename( __FILE__))) ; 
				$trans = new SLFramework_Feedback($plugin,  $this->pluginID) ; 
				$trans->enable_feedback() ; 
			$tabs->add_tab(__('Give feedback',  $this->pluginID), ob_get_clean() , plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_mail.png") ; 	
			
			ob_start() ; 
				$trans = new SLFramework_OtherPlugins("sedLex", array('wp-pirates-search')) ; 
				$trans->list_plugins() ; 
			$tabs->add_tab(__('Other plugins',  $this->pluginID), ob_get_clean() , plugin_dir_url("/").'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_plug.png") ; 	
			

			echo $tabs->flush() ; 
			
			echo $this->signature ; ?>
		</div>
		<?php
	}
}

$updatemessage = imagezoom::getInstance();

?>