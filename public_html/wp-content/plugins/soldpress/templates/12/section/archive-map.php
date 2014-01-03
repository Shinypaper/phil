<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$tag = 1;
	$values = "";
?>
 <div class='location-finder'>
	<div class='left-side'>
<?php while ( have_posts() ) : the_post(); ?>

<article rel='<?php echo $tag?>'>
<?php 
/*$photos = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
if ($photos) {
		foreach ($photos as $photo) {
			echo '<figure><a href="' . get_permalink() . '"><img src="' . wp_get_attachment_url($photo->ID,'thumbnail') . '" /></a></figure>';
			break;
		}
}else{
		echo '<figure><a href="' .   get_permalink()  . '"><img src="' . plugins_url( 'images/soldpress.jpg' , __FILE__ ) . '" /></a></figure>';
}
*/
echo '<figure><a href="' . get_permalink() . '"><image src="' . sp_get_default_listing_image($post->post_name) . '" /></a></figure>';

?>
<div class='text'>
	<h3><?php echo esc_html( get_post_meta($post->ID,'dfd_UnparsedAddress',true)) ?></h3>
	<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_City', true ) ); ?> , <?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_StateOrProvince', true ) ); ?></p>
	
		<?php if(get_post_meta(get_the_ID(), 'dfd_ListPrice', true ) != 0) { ?>
			<span class='price'>$<?php echo esc_html( number_format(get_post_meta( get_the_ID(), 'dfd_ListPrice', true )) ); ?></span>
			<?php } ?>
</div>
</article>
<?php 

if($tag != 1){
	$values = $values . ',';
}

$values = $values .  '{address:"' . get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta( get_the_ID(), 'dfd_StateOrProvince', true ) . ' ' . get_post_meta( get_the_ID(), 'dfd_PostalCode', true ). '", data:" ' . get_post_meta($post->ID,'dfd_UnparsedAddress',true) . '", tag : "'.$tag.'"}';

$tag = $tag + 1;

?>
<?php endwhile; ?>
</div>
<div class='right-side'>
                                <a href="#" class='button-slider expanded'></a>
                                <div id="map_canvas"></div>
                            </div>
</div>
 <script type="text/javascript">
            jQuery(document).ready(function() {
			
				 jQuery('.location-finder article').click(function() {
					var tag = jQuery(this).attr('rel');
					var title = jQuery(this).find('h3').text();
					var address = jQuery(this).find('p').text();
					var html = '<strong>'+title+'</strong> <br />'+address;
					jQuery('#map_canvas').gmap3({
						exec: {
							tag : tag,
							all:"true",
							func: function(data){
								// data.object is the google.maps.Marker object
								data.object.setIcon("http://maps.google.com/mapfiles/marker_black.png");

								var map = jQuery('#map_canvas').gmap3("get"),
									infowindow = jQuery('#map_canvas').gmap3({get:{name:"infowindow"}});
								if (infowindow){
									infowindow.open(map, data.object);
									infowindow.setContent(html);
								} else {
									jQuery('#map_canvas').gmap3({
										infowindow:{
											anchor: data.object,
											options:{content: html}
										}
									});
								}


							}
						}
					});
				});
			
				 jQuery('.location-finder article').hover(function() {
					var tag = jQuery(this).attr('rel');
					jQuery('#map_canvas').gmap3({
						exec: {
							tag : tag,
							all:"true",
							func: function(data){
								// data.object is the google.maps.Marker object
								data.object.setIcon("http://maps.google.com/mapfiles/marker_white.png")
							}
						}
					});
				}, function() {
					var tag = jQuery(this).attr('rel');
					jQuery('#map_canvas').gmap3({
						exec: {
							tag : tag,
							all:"true",
							func: function(data){
								// data.object is the google.maps.Marker object
								data.object.setIcon("http://maps.google.com/mapfiles/marker.png")
							}
						}
					});
				});
			
                jQuery('#map_canvas').gmap3({							
                            map:{
                                 options:{
									center:[60.413852,-111.824341],
                                    zoom: 3
                                }
                            },
                            marker:{
                                values:[
									<?php echo $values?>
                                ],
                                options:{
                                    draggable: false
                                },
                                events:{
                                    mouseover: function(marker, event, context){
                                        var map = jQuery(this).gmap3("get"),
                                                infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
                                        marker.setIcon("http://maps.google.com/mapfiles/marker_white.png");
                                        if (infowindow){
                                            infowindow.open(map, marker);
                                            infowindow.setContent(context.data);
                                        } else {
                                            jQuery(this).gmap3({
                                                infowindow:{
                                                    anchor:marker,
                                                    options:{content: context.data}
                                                }
                                            });
                                        }
                                    },
                                    mouseout: function(marker){
                                        var infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
                                        marker.setIcon("http://maps.google.com/mapfiles/marker.png");
                                        if (infowindow){
                                            infowindow.close();
                                        }
                                    }
                                }
                            }
                },
                "autofit" );
            });
        </script>