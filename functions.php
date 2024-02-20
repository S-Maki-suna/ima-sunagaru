<?php
//CSSの読み込み
function theme_enqueue_styles() {
    //親スタイルシート→子スタイルシートの順
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/_g3/assets/css/style.css' );
wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array('parent-style')
);
}


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function imasunagaru_post_type(){
    //カスタム投稿登録
    register_post_type(
        // カスタム投稿名設定
        'event',
        array(
            'label' => 'イベント',//管理画面の名前
            'public' => true,//サイトに表示するかどうか
            'has_archive' => true,
            'show_in_rest' => true,
            'menu_position' => 5,//管理メニューの何番目か
			'menu_icon' => 'dashicons-smiley',
            'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            ),
        )
		);
    register_post_type(
            // カスタム投稿名設定
        'movie',
        array(
            'label' => '動画',//管理画面の名前
            'public' => true,//サイトに表示するかどうか
            'has_archive' => true,
            'show_in_rest' => true,
            'menu_position' => 6,//管理メニューの何番目か
            'menu_icon' => 'dashicons-smiley',
            'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            ),
        )
        );
}
add_action('init','imasunagaru_post_type');

function video_display(){
	$args = array(
        'post_type' => 'movie',//投稿タイプ
        'post_per_page' => 1,//表示する記事数
	);
	$query = new WP_query($args);//表示の設定を$queryで呼び出せる
		while($query->have_posts()):
        $query->the_post(); 
	get_template_part('template-parts/movie');
	endwhile; 
	wp_reset_postdata();
}
add_action( 'lightning_site_body_prepend', 'video_display' );