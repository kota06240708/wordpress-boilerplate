<?php get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<a href="<?php the_permalink(); ?>">
	   <h1 class="entry-title"><?php the_title(); ?></h1>
	   <div>
		 <?php the_content(); ?>
	  </div>
	<a href="<?php the_permalink(); ?>">
  </article>
  <hr/>
	<?php endwhile; ?>

<?php get_footer(); ?>
