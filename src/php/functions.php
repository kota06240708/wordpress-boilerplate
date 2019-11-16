<?php

function add_css() {
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'add_css' );

// カスタム投稿タイプの追加
function create_post_type() {
    register_post_type( "news", // 投稿タイプ名の定義
    array(
      "labels" => array(
        "name" => __( "新着情報" ), // 表示する投稿タイプ名
        "singular_name" => __( "新着情報" )
      ),
      "public" => true,
      'has_archive' => false,
      "menu_position" => 5, // menuの位置を指定できる
      'taxonomies' => array( 'category', 'post_tag' ),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments' ) // カスタム投稿タイプで表示できる内容
    )
  );
}

add_action( "init", "create_post_type" );

function twentyfifteen_widgets_init() {
  register_sidebar( array(
      'name' => 'Widget Area',
      'id' => 'sidebar-1',
      'description' => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
  ) );
  /* 追加分 */
  register_sidebar( array(
      'name' => 'コンテンツウィジェット',
      'id' => 'content-widget',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
  ) );
}

add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

// ウイジェットを作成
class MySampleWidgetParam extends WP_Widget{

	//コンストラクタでウィジェットを登録
	function __construct(){
		parent::__construct(
			'my_sample_widget_id002',	//ウィジェットID
			'パラメータありのサンプル',	//ウィジェット名
			array('description' => '入力したテキストを赤色で表示します。')	//ウィジェットの概要
		);
	}

	//ウィジェットの表示
	public function widget($args, $instance){
		echo $args['before_widget']; // ここに

		//-- ここにウィジェットの内容 --//
		$dest_text = !empty($instance['setting_text']) ? $instance['setting_text'] : '';
		echo $args['before_title'] . '<span class='.$instance['limit'].' style="color:red;">' . $dest_text . '</span>' . $args['after_title'];

		echo $args['after_widget'];
	}

	//ウィジェットフォームの作成
	public function form($instance){
		$dest_text = !empty($instance['setting_text']) ? $instance['setting_text'] : '';
		?>
      <!-- setting_text、limitという名前はなんでもいい -->

      <!-- 文言を追加 -->
      <p>
        <label for="<?php echo $this->get_field_id('setting_text'); ?>">表示したい文字</label>
        <input id="<?php echo $this->get_field_id('setting_text'); ?>" name="<?php echo $this->get_field_name('setting_text'); ?>" type="text" value="<?php echo esc_attr($dest_text); ?>">
      </p>

      <!-- 数を定義できる -->
      <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('表示する投稿数:'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" size="3">
      </p>
		<?php
	}

	//入力されたデータの更新処理
	//	new_instance：更新後の値
	//	old_instance：更新前の値
	public function update($new_instance, $old_instance){
    $instance = array();

    // 文言を定義できる
    $instance['setting_text'] = !empty($new_instance['setting_text']) ? $new_instance['setting_text'] : '';

    // 表示する数を定義できる
    $instance['limit'] = is_numeric($new_instance['limit']) ? $new_instance['limit'] : 5;

		return $instance;	//更新されたデータが入った配列を戻り値として返す
	}
}

add_action(
	'widgets_init',
	function(){
		register_widget('MySampleWidgetParam');	//
	}
);
