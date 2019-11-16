<?php
/*
Template Name: 記事一覧
*/
?>

<?php get_header(); ?>

<main>
<div class="front-wrap">
  <div class="front-inner">
    <ul class="front-list">
      <li class="front-lists">
        <a class="front-lists-link" href="<?php echo get_permalink( get_page_by_path( 'contact' )->ID ); ?>">
          コンタクトページ
        </a>
      </li>
    </ul>
    <?php
      global $post;

      $names = get_post_types( array( 'public'  => true, '_builtin' => false ) );

      //投稿数
      $args = array(
        'posts_per_page' => 8,
        'post_type' => ['post'] // 投稿の一覧を表示
      );
      $myposts = get_posts( $args );

      //ループで回す
      foreach( $myposts as $post ) {
      setup_postdata($post);
    ?>

    <!-- パーマリンク -->
    <a href="<?php the_permalink() ?>">
      <!-- サムネイルがあったら表示 -->
      <?php if(has_post_thumbnail()): ?>
        <?php the_post_thumbnail('medium'); ?>
      <?php else: ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="no-img"/>
      <?php endif; ?>
    </a>


    <dl>
      <dt>
        <!-- 投稿日付 -->
        <?php the_time('Y.m.d') ?>
        <!-- 投稿カテゴリ -->
        <?php the_category('｜') ?>
      </dt>
      <dd>
        <!-- パーマリンク -->
        <a href="<?php the_permalink() ?>">
          <!-- タイトル -->
          <?php the_title(); ?>
        </a>
      </dd>
    </dl>


    <?php
    }
    wp_reset_postdata();
    ?>
  </div>
</div>
</main>

<?php get_footer(); ?>
