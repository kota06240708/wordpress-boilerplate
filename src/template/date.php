<?php get_header(); ?>

<main>

<p><?php echo get_the_date('Y年n月'); ?></p>

<?php if(have_posts()): while(have_posts()):the_post(); ?>

  <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

  <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
  <p><?php the_category(', '); ?></p>

<?php endwhile; endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
