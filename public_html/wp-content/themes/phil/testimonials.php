<?php get_header();

/*
Template Name: Testimonials
*/
 ?>
<div class="testimonal">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="<?php post_class(); ?>">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</article>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
</div>


<?php get_footer(); ?>