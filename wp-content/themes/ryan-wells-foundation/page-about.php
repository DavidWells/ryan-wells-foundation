<?php
/*
* Template Name: About us
*/

get_header();

// Layout
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );
if ( empty ( $layout ) ) { $layout = 'cs'; }

// Content Class
$content_class = '';
if ( $layout == 'cs' ) { $content_class = 'two-thirds column'; }

?>

	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

				<?php

					the_post();
					$page_id = get_the_ID(); ?>

<div <?php post_class( 'page-single' ); ?>>

	<div class="page-single-main">

		<h1 class="page-single-title"><?php the_title(); ?></h1>

		<div class="page-post-content">
		<div class="main">


			<div class="shell">

				<?php $vertical_sections = get_field('vertical_sections', $page_id, 'complex');
				if(!empty($vertical_sections)) :

					$id_safe_prefix = 'slp-'; ?>
					<div class="long-container">


						<div class="content">
							<?php foreach($vertical_sections as $section) :

								$sanitized_side_title = sanitize_title_with_dashes($section['side_title']);  ?>
								<div class="section" id="<?php echo $id_safe_prefix . $sanitized_side_title; ?>">
									<?php if(!empty($section['section_title'])) : ?>
										<h2 class="entry-title"><?php echo $section['section_title']; ?></h2>
									<?php endif;

									if($section['acf_fc_layout'] == 'content') :
										echo wpautop(do_shortcode($section['content']));
									elseif($section['acf_fc_layout'] == 'content_left_image') : ?>
										<div class="meet-founder">
											<?php if(!empty($section['image']['id'])) : ?>
												<div class="alignleft">
													<?php $img_obj = wp_get_attachment_image_src($section['image']['id'], 'full'); ?>
													<img src="<?php echo crb_get_thumb_url($img_obj[0], 248, 249); ?>" alt="" />
												</div>
											<?php endif;

											if(!empty($section['content'])) {
												echo wpautop(do_shortcode($section['content']));
											} ?>
										</div>
									<?php elseif($section['acf_fc_layout'] == 'team_members') :
										if(!empty($section['content'])) {
											echo wpautop(do_shortcode($section['content']));
										}

										if(!empty($section['team_members'])) : ?>
											<div class="team-holder">
												<?php $count = 0;
												 foreach($section['team_members'] as $member) :


													global $post;
													$post = $member;
													setup_postdata($post);
													$entry_id = get_the_ID();
													$entry_link = get_permalink($entry_id);
													$entry_image = get_field('member_image', $entry_id);
													$entry_title = get_the_title($entry_id);
													$entry_position = get_field('member_position', $entry_id);

													$img_obj = wp_get_attachment_image_src($entry_image, 'full'); ?>
													<div class="person person_<?php echo $count;?>">
														<a href="<?php echo $entry_link; ?>" class="person-inner-wrapper">
															<img src="<?php echo crb_get_thumb_url($img_obj[0], 210, 210); ?>" alt="" />
															<strong><?php echo $entry_title; ?></strong>
															<?php echo $entry_position; ?>
														</a>
													</div>
												<?php
													$count++;
													if (($count % 3) == 0) {
													   echo "<div style='clear:both;'></div>";
													}

												endforeach;
												wp_reset_postdata(); ?>
											</div>
										<?php endif;

									elseif($section['acf_fc_layout'] == 'content_with_slider') :
										if(!empty($section['content'])) {
											echo wpautop(do_shortcode($section['content']));
										}

										if(!empty($section['slider'])) : ?>
											<div class="slider-wrapper">
												<div class="caption-slider">
													<ul class="slides">
														<?php foreach($section['slider'] as $entry) :

															$img_obj = wp_get_attachment_image_src($entry['background_image']['id'], 'full'); ?>
															<li>
																<div class="caption-head">
																	<img src="<?php echo crb_get_thumb_url($img_obj[0], 825, 420); ?>" alt="" />

																	<div class="cnt">
																		<h2><?php echo $entry['title']; ?></h2>
																		<?php if(!empty($entry['sub_title'])) : ?>
																			<p><?php echo $entry['sub_title']; ?></p>
																		<?php endif; ?>
																	</div><!-- /.cnt -->
																</div>
												<?php 	if ($entry['content'] === "" || empty($entry['content'])) {
															$style="style='display:none;'";
														} else {
															$style="";
														}
												?>
																<div class="caption-cnt" <?php echo $style;?> >
																	<?php echo wpautop($entry['content']); ?>
																</div>
															</li>
														<?php endforeach; ?>
													</ul>
												</div>
											</div>
										<?php endif;

									elseif($section['acf_fc_layout'] == 'content_with_news') :
										if(!empty($section['content'])) {
											echo wpautop(do_shortcode($section['content']));
										}

										$args = array(
											'post_type' => 'crb_news_article',
											'posts_per_page' => 8,
										);
										$news_articles = get_posts($args);
										if(!empty($news_articles)) :

											$number_of_entries = count($news_articles);
											$divide_on = ceil($number_of_entries / 2); ?>
											<div class="cols">
												<div class="col">
													<?php $counter = 1;
													$date_format = 'F jS Y';
													foreach($news_articles as $entry) :

														$entry_id = $entry->ID;
														$entry_link = get_permalink($entry_id);
														$entry_title = get_the_title($entry_id);
														$entry_date = get_the_time($date_format, $entry); ?>
														<div class="post">
															<h5>
																<a href="<?php echo $entry_link; ?>" target="_blank"><?php echo $entry_title; ?></a>
															</h5>

															<div class="post-date">
																<p><?php echo $entry_date; ?></p>
															</div>
														</div>
														<?php if($counter==$divide_on) : ?>
															</div>
															<div class="col">
														<?php endif;
														$counter++;

													endforeach; ?>
												</div>
											</div>
										<?php endif;

										if(!empty($section['bottom_content'])) :
											echo wpautop(do_shortcode($section['bottom_content']));
										endif; ?>

									 <a class="yellow-btn" style="" href="/news/">More SLP News</a>
									<?php
									elseif($section['acf_fc_layout'] == 'content_with_form') :
										if(!empty($section['content'])) {
											echo wpautop(do_shortcode($section['content']));
										}

										if(!empty($section['contact_form_id'])) :

											if(function_exists('gravity_form')) :

												$tab_index = mt_rand(0, 9999); ?>
												<div class="contact-form">
													<?php gravity_form($section['contact_form_id'], false, false, false, null, true, $tab_index); ?>
												</div><!-- /.contact-form -->
											<?php endif;

										endif;

									elseif($section['acf_fc_layout'] == 'timeline') :
										if(!empty($section['content'])) {
											echo wpautop(do_shortcode($section['content']));
										}
										?>
										<div class="timeline">


											<?php foreach ($section["timeline"] as $idx=>$timeline_item): ?>
												<div class="timeline_item <?php echo $idx%2==0?'item_right':'item_left'; ?>">
													<div class="timeline_item_date">
														<?php if ($timeline_item['date']): ?>
															<div class="timeline_item_date_inner <?php echo (strlen($timeline_item['date'])>5)?"multiline":"" ?>">
																<?php echo $timeline_item['date'] ?>
															</div>
														<?php endif; ?>
													</div>
													<div class="timeline_item_content">
														<h5 class="timeline_item_title">
															<?php if ($timeline_item['link']) { ?>
															<a target="_blank" href="<?php echo $timeline_item['link'] ?>"><?php echo $timeline_item['title'] ?>
															</a>
															<?php } else { ?>
																<?php echo $timeline_item['title'] ?>
															<?php } ?>
														</h5>
														<p><?php echo $timeline_item['description'] ?></p>
													</div>
													<div class="timeline_item_image">
														<?php if ($timeline_item['image']): ?>
															<?php echo wp_get_attachment_image($timeline_item['image']['id'], 'crb_48_50', false); ?>
														<?php endif ?>
													</div>
												</div>
											<?php endforeach ?>

										</div>

										<?php

									endif; ?>
								</div><!-- /.section -->
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div><!-- /.shell -->
		</div><!-- /.main -->
</div>
</div>
</div>

		</div>


	</div><!-- .container -->

<?php get_footer(); ?>