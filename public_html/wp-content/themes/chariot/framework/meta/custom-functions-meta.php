<?php 

/*-----------------------------------------------------------------------------------*/
/*	Custom-Functions
/*-----------------------------------------------------------------------------------*/

// Page Header Settings
if ( !function_exists( 'az_page_header' ) ) {
    function az_page_header($postid) {
		
		global $options;
		global $post;
		
		$check_page_settings = get_post_meta($postid, '_az_header_settings', true);
    	$bg = get_post_meta($postid, '_az_header_bg', true);
		$bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
		$bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
		$page_title = get_post_meta($postid, '_az_page_title', true);
		$page_caption = get_post_meta($postid, '_az_page_caption', true);
		$page_align_text = get_post_meta($postid, '_az_page_text_align', true);
		$rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);
	?>		
	
    <?php if ( $check_page_settings == "enabled") { ?>
		
    <?php if( !empty($bg) ) { ?> 
        <section id="image-static">
        <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"></span>'; } ?>
		 <div class="fullimage-container <?php if( !empty($page_title) || !empty($page_caption) ) { ?> <?php echo 'titlize'; ?><?php } ?>" style="background: url('<?php echo $bg; ?>') center center no-repeat; background-attachment: <?php echo $bgattachment; ?>; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
         	
            <?php if( !empty($page_title) || !empty($page_caption) ) { ?>
            <div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
                        <h2><?php echo $page_title; ?></h2>
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } ?>
            		</div>
            	</div>
            </div>
            <?php } ?>
            
         </div>
        </section>
	    <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
		<?php } else { ?>
        <section id="title-page">
        	<span class="overlay-bg-fill"></span>
        	<div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } ?>
            		</div>
            	</div>
            </div>
        </section>
		<?php } ?>
    
    <?php }
    }
}

// Page Team Header Settings
if ( !function_exists( 'az_page_header_team' ) ) {
    function az_page_header_team($postid) {
		
		global $options;
		global $post;
		global $socials_profiles;
		
		$check_page_settings = get_post_meta($postid, '_az_header_settings', true);
		$check_profile_settings = get_post_meta($postid, '_az_profile_settings', true);
		
    	$bg = get_post_meta($postid, '_az_header_bg', true);
		$bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
		$bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
		$page_title = get_post_meta($postid, '_az_page_title', true);
		$page_caption = get_post_meta($postid, '_az_page_caption', true);
		$page_align_text = get_post_meta($postid, '_az_page_text_align', true);
		$rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);
		
		$attrs = get_the_terms( $post->ID, 'attributes' );
		$attributes_fields = NULL;
		
		if ( !empty($attrs) ){
		 foreach ( $attrs as $attr ) {
		   $attributes_fields[] = $attr->name;
		 }
		 
		 $on_attributes = join( " - ", $attributes_fields );
		}
	?>		
	
    <?php if ( $check_page_settings == "enabled") { ?>
		
    <?php if( !empty($bg) ) { ?> 
        <section id="image-static">
        <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"></span>'; } ?>
		 <div class="fullimage-container <?php if( !empty($page_title) || !empty($page_caption) ) { ?> <?php echo 'titlize'; ?><?php } ?>" style="background: url('<?php echo $bg; ?>') center center no-repeat; background-attachment: <?php echo $bgattachment; ?>; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
         
		 	<?php if( !empty($page_title) || !empty($page_caption) ) { ?>
            <div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
                        <h2><?php echo $page_title; ?></h2>
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } ?>
            		</div>
            	</div>
            </div>
            <?php } ?>
            
         </div>
        </section>
	    <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
		<?php } else { ?>
        <section id="title-page">
        	<span class="overlay-bg-fill"></span>
        	<div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        	<h2><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        	<h2><?php echo the_title(); ?></h2>
                        <?php } ?>
                        
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } else { ?>
                        	<p class="page-caption"><?php echo $on_attributes; ?></p>
                        <?php } ?>
            		</div>
            	</div>
            </div>
        </section>
		<?php } ?>
    
    <?php }
    }
}

// Page Portfolio Header Settings
if ( !function_exists( 'az_page_header_portfolio' ) ) {
    function az_page_header_portfolio($postid) {
		
		global $options;
		global $post;
		
		$check_page_settings = get_post_meta($postid, '_az_header_settings', true);
		
    	$bg = get_post_meta($postid, '_az_header_bg', true);
		$bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
		$bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
		$page_title = get_post_meta($postid, '_az_page_title', true);
		$page_caption = get_post_meta($postid, '_az_page_caption', true);
		$page_align_text = get_post_meta($postid, '_az_page_text_align', true);
		$rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);
		
		$attrs = get_the_terms( $post->ID, 'project-attribute' );
		$attributes_fields = NULL;
		
		if ( !empty($attrs) ){
		 foreach ( $attrs as $attr ) {
		   $attributes_fields[] = $attr->name;
		 }
		 
		 $on_attributes = join( " - ", $attributes_fields );
		}
	?>		
	
    <?php if ( $check_page_settings == "enabled") { ?>
		
    <?php if( !empty($bg) ) { ?> 
        <section id="image-static">
        <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"></span>'; } ?>
		<div class="fullimage-container <?php if( !empty($page_title) || !empty($page_caption) ) { ?> <?php echo 'titlize'; ?><?php } ?>" style="background: url('<?php echo $bg; ?>') center center no-repeat; background-attachment: <?php echo $bgattachment; ?>; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        	
			<?php if( !empty($page_title) || !empty($page_caption) ) { ?>
            <div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
                        <h2><?php echo $page_title; ?></h2>
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } ?>
            		</div>
            	</div>
            </div>
            <?php } ?>
            
        </div>
        </section>
	    <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
		<?php } else { ?>
        <section id="title-page">
        	<span class="overlay-bg-fill"></span>
        	<div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
						<?php if( !empty($page_title) ) { ?>
                        	<h2><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        	<h2><?php echo the_title(); ?></h2>
                        <?php } ?>
                        
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } else { ?>
                        	<p class="page-caption"><?php echo $on_attributes; ?></p>
                        <?php } ?>
            		</div>
            	</div>
            </div>
        </section>
		<?php } ?>
    
    <?php }
    }
}

// Single Posts Header Settings
if ( !function_exists( 'az_post_header' ) ) {
    function az_post_header($postid) {
		
		global $options;
		global $post;
		
		$check_page_settings = get_post_meta($postid, '_az_header_settings', true);
		
    	$bg = get_post_meta($postid, '_az_header_bg', true);
		$bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
		$bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
		$page_title = get_post_meta($postid, '_az_page_title', true);
		$page_caption = get_post_meta($postid, '_az_page_caption', true);
		$page_align_text = get_post_meta($postid, '_az_page_text_align', true);
		$rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);
		
	?>		
	
    <?php if ( $check_page_settings == "enabled") { ?>
		
    <?php if( !empty($bg) ) { ?> 
        <section id="image-static">
        <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"></span>'; } ?>
		<div class="fullimage-container titlize" style="background: url('<?php echo $bg; ?>') center center no-repeat; background-attachment: <?php echo $bgattachment; ?>; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        	
            <div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
						 <?php if( !empty($page_title) ) { ?>
                        	<h2><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        	<h2><?php echo the_title(); ?></h2>
                        <?php } ?>
                        
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } else { ?>
                            <div class="entry-meta entry-header">
                                <span class="published"><?php the_time( get_option('date_format') ); ?></span>
                                <span class="meta-sep"> / </span>
                                <span class="comment-count"><?php comments_popup_link(__('No Comments', AZ_THEME_NAME), __('1 Comment', AZ_THEME_NAME), __('% Comments', AZ_THEME_NAME)); ?></span>
                                <?php edit_post_link( __('Edit', AZ_THEME_NAME), ' / <span class="edit-post">', '</span>' ); ?>
                            </div>
                        <?php } ?>
            		</div>
            	</div>
            </div>
         
        </div>
        </section>
	    <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
		<?php } else { ?>
        <section id="title-page">
        	<span class="overlay-bg-fill"></span>
        	<div class="container pagize">
            	<div class="row">
                	<div class="col-md-12 <?php echo $page_align_text; ?>">
						 <?php if( !empty($page_title) ) { ?>
                        	<h2><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        	<h2><?php echo the_title(); ?></h2>
                        <?php } ?>
                        
                        <?php if( !empty($page_caption) ) { ?>
                        	<p class="page-caption"><?php echo $page_caption; ?></p>
                        <?php } else { ?>
                            <div class="entry-meta entry-header">
                                <span class="published"><?php the_time( get_option('date_format') ); ?></span>
                                <span class="meta-sep"> / </span>
                                <span class="comment-count"><?php comments_popup_link(__('No Comments', AZ_THEME_NAME), __('1 Comment', AZ_THEME_NAME), __('% Comments', AZ_THEME_NAME)); ?></span>
                                <?php edit_post_link( __('Edit', AZ_THEME_NAME), ' / <span class="edit-post">', '</span>' ); ?>
                            </div>
                        <?php } ?>
            		</div>
            	</div>
            </div>
        </section>
		<?php } ?>
    
    <?php }
    }
}

// Video

function az_post_video($id){

	$m4v = get_post_meta($id, '_az_video_m4v', true);
	$ogv = get_post_meta($id, '_az_video_ogv', true);
	$poster_video = get_post_meta($id, '_az_video_poster_url', true);
	$video_embed = get_post_meta($id, '_az_video_embed', true);
	
	if( !empty( $video_embed ) ) {?>
        <div class="video-wrap">
            <div class="video-embed">
            <?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
            </div>
        </div>
	<?php } else { ?>
		<video id="video-<?php echo $id; ?>" class="video-js vjs-default-skin" controls preload="auto" style="width:100%; height:100%;" poster="<?php echo $poster_video; ?>">
			<source src="<?php echo $m4v; ?>" type="video/mp4">
			<source src="<?php echo $ogv; ?>" type="video/ogg">
		</video>
	<?php }
	
}

// Audio

function az_post_audio($id){

	$mp3 = get_post_meta($id, '_az_audio_mp3', true);    	
	?>
    	
    <div id="audio-<?php echo $id; ?>">
		<audio style="width:100%; height:30px;" class="audio-js" controls preload src="<?php echo $mp3; ?>"></audio>
    </div>
	
<?php 
}

// Footer Widget Area
if ( !function_exists( 'az_footer_widget' ) ) {
    function az_footer_widget($postid) {

		global $post;
		$options = get_option('chariot');
		$check_page_settings = get_post_meta($postid, '_az_footer_widget_settings', true);
	?>		
	
    <?php if ( $check_page_settings == "enabled") { ?>
		
<!-- Start Footer with Widgets -->
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <?php
                $footerColumns = (!empty($options['footer-widget-columns'])) ? $options['footer-widget-columns'] : '3'; 
                    
                if($footerColumns == '2'){
                    $footerColumnClass = 'col-md-6';
                } else if($footerColumns == '4'){
                    $footerColumnClass = 'col-md-3';
                } else {
                    $footerColumnClass = 'col-md-4';
                }
                ?>
                <div class="<?php echo $footerColumnClass;?>">
                    <?php if ( function_exists('dynamic_sidebar') ) { ?>
                        <?php dynamic_sidebar('footer-area-one'); ?>
                    <?php } ?>
                </div>

                <div class="<?php echo $footerColumnClass;?>">
                    <?php if ( function_exists('dynamic_sidebar') ) { ?>
                        <?php dynamic_sidebar('footer-area-two'); ?>
                    <?php } ?>
                </div>

                <?php if($footerColumns == '3' || $footerColumns == '4') { ?>
                <div class="<?php echo $footerColumnClass;?>">
                    <?php if ( function_exists('dynamic_sidebar') ) { ?>
                        <?php dynamic_sidebar('footer-area-three'); ?>
                    <?php } ?>
                </div>
                <?php } ?>

                <?php if($footerColumns == '4') { ?>
                <div class="<?php echo $footerColumnClass;?>">
                    <?php if ( function_exists('dynamic_sidebar') ) { ?>
                        <?php dynamic_sidebar('footer-area-four'); ?>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<!-- End Footer with Widgets -->
		<?php } ?>
    <?php }
}
?>