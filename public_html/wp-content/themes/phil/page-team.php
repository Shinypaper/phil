<?php 
	// Template Name: Team Page
get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>
			<div class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="page_title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<div class="phil_team_wrapper">
					
					<div class="phil_team">
						<img src="http://api.randomuser.me/0.3/portraits/women/3.jpg" alt="">
						<div class="phil_member_wrap">
							<h3>Phil</h3>
							<p>Philip Stavrou is a proud member of Right At Home's 2012 Chairman's Club -- which recognizes the top 3% of Right At Home Realty's 2400+ sales force. Prior to becoming a successful real estate salesperson, Philip Stavrou was employed as an online writer for CTV NEWS. During his time at CTV, Philip interviewed and wrote about a wide range of newsmakers, celebrities, social and economic experts, and everyday people with interesting stories. As a journalist, he was sent out to cover everything from the release of the federal budget in Ottawa to the red carpet mayhem at the Toronto International Film Festival. He later moved on to become the first ever Web Editor for Post City Magazines, a local monthly in Toronto that focuses on food, entertainment and, of course, real estate. It was there that he helped build the website, including its Real Estate blog, from the ground up while also networking with some of the biggest names in Toronto's real estate industry. With a strong communication and business background, Philip eventually took his skills and made the transition into the fast-paced world of buying and selling real estate that he already knew so intimately. Ever since, he's been one of Toronto's most in-demand Realtors, having sold millions worth of real estate in the GTA. His honesty, market knowledge, experience and friendly demeanour separate him from the pack and will ensure that your next real estate transaction is, like the many clients before you, a successful one!</p>
						</div>
					</div>

				</div>

				

				<article class="team_members">
					<div class="members-wrap">
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/women/3.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>Jane Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/women/3.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>Jane Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/men/46.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/men/3.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>

<?php get_footer(); ?>