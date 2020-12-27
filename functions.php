<?php

function fr_favorites_content($content) {
    if ( !is_single() or !is_user_logged_in() ) return $content;
    $img_src = plugins_url( 'img/loader.gif', __FILE__ );

    global $post;
    if (fr_is_favorite($post->ID)) {
        return '<p class="fr_favorites_remove_link"><a href="#"> Удалить из избранного </a></p>'.$content;
    }

    return '<p class="fr_favorites_link"><span class="fr_favorites_hidden"><img src="'.$img_src.'" alt=""></span> <a href="#"> Добавить в избранное </a></p>'.$content;
}

function fr_favorites_scripts() {
    if (!is_user_logged_in() or  !is_single()) return;
    wp_enqueue_script('main', plugins_url('/scripts/main.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_style('style', plugins_url('/styles/style.css', __FILE__));
    global $post;
    wp_localize_script('main', 'frFavorites',
    ['url' => admin_url('admin-ajax.php') ,
    'nonce' => wp_create_nonce('fr-favorites'), 'postId' => $post->ID]);
}

function wp_ajax_fr_test() {
    if ( !wp_verify_nonce( $_POST['security'], 'fr-favorites' )) {
        wp_die('Ошибка');
    }
    $post_id = (int)$_POST['postId'];
    $user = wp_get_current_user();

    if (fr_is_favorite($post_id)) wp_die();

    if (add_user_meta($user->ID, 'fr_favorites', $post_id)) {
        wp_die('Добавлено!');
    }

    wp_die('Ошибка добавления!');
}

function fr_is_favorite($post_id) {
    $user = wp_get_current_user();
    $favorites = get_user_meta($user->ID, 'fr_favorites');
    foreach($favorites as $favorite) {
        if ($favorite == $post_id) return true;
    }
    return false;
}
?>