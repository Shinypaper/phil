<?php header("Content-type: text/css; charset=utf-8"); 

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );

$options = get_option('chariot'); 
?>

a,
.single-people .team-name:hover h3,
.item-project .project-name:hover h3,
.masonry-portfolio .item-project .project-name:hover h3,
#latest-posts .post-name .entry-title a:hover,
.standard-blog .post-link .entry-title a:hover,
.standard-blog .post-quote .entry-title a:hover,
.standard-blog .post-name .entry-title a:hover,
.standard-blog .post-link .link-source a:hover,
.standard-blog .post-quote .quote-source a:hover,
.masonry-blog .post-link .entry-title a:hover,
.masonry-blog .post-quote .entry-title a:hover,
.masonry-blog .post-name .entry-title a:hover,
.masonry-blog .post-link .link-source a:hover,
.masonry-blog .post-quote .quote-source a:hover,
.comment-author cite a:hover,
.comment-meta a:hover,
#social-footer ul li a i,
#footer-credits p a,
.tagcloud a,
.social_widget a i,
.box .icon i,
.dropmenu-active ul li a:hover,
.color-text,
.dropcap-color,
.social-icons li a i,
.icons-example ul li a i,
header #logo a:hover,
header #logo a:focus,
header #logo a:active,
#menu ul a:hover,
#menu ul li.sfHover a,
#menu ul li.current-cat a,
#menu ul li.current_page_item a,
#menu ul li.current-menu-item a,
#menu ul li.current-page-ancestor a,
#menu ul li.current-menu-ancestor a,
#navigation-mobile li a:hover {
    color: <?php echo $options['accent-color']; ?>;
}

#menu ul .sub-menu li a:hover {
	color: <?php echo $options['accent-color']; ?> !important;
}

.overlay-bg,
.overlay-bg-fill,
.fancy.italic_border span:before,
.fancy.default_border span:before,
.fancy.italic_border span:after,
.fancy.default_border span:after,
.single-people .hover-wrap .overlay,
.item-project .hover-wrap .overlay,
.navigation-projects ul li.prev a:hover,
.navigation-projects ul li.next a:hover,
.navigation-projects ul li.back-page a:hover,
.wpcf7 .wpcf7-submit,
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a,
.post-thumb .hover-wrap .overlay,
.badge_author,
#commentform #submit,
#social-footer ul li a:hover,
.tagcloud a:hover,
.tagcloud a:active,
.tagcloud a:focus,
.social_widget a:hover,
#jpreOverlay,
#jSplash,
.fancybox-nav:hover span,
.button-main,
.button-main.inverted:hover,
.button-main.inverted:active,
.button-main.inverted:focus,
.box:hover .icon,
.box:active .icon,
.box:focus .icon,
.tooltip-inner,
.highlight-text,
.progress-bar .bar,
.fancy-wrap .overlay,
.pricing-table.selected .price,
.pricing-table.selected .confirm,
.mejs-overlay:hover .mejs-overlay-button,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.social-icons li a:hover,
.icons-example ul li a:hover {
	background-color: <?php echo $options['accent-color']; ?>;
}

#social-footer ul li a,
.tagcloud a,
.social_widget a,
.box .icon,
.dropcap-color,
.social-icons li a,
.icons-example ul li a {
	border-color: <?php echo $options['accent-color']; ?>;
}

.tooltip.top .tooltip-arrow {
    border-top-color: <?php echo $options['accent-color']; ?>;
}

.tooltip.right .tooltip-arrow {
    border-right-color: <?php echo $options['accent-color']; ?>;
}

.tooltip.left .tooltip-arrow {
    border-left-color: <?php echo $options['accent-color']; ?>;
}

.tooltip.bottom .tooltip-arrow {
    border-bottom-color: <?php echo $options['accent-color']; ?>;
}