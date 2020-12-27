<?php
/*
Plugin Name: addFavorites
Description: Данный плагин осуществляет
возможность добавления статей в категорию
избранных, то есть сохранение на базовом уровне.
Version: 0.1
Author: Nikita Marakushev
Author URI: https://internet.com
*/
require __DIR__ . '/functions.php';

//Код плагина
add_filter( 'the_content', 'fr_favorites_content');
add_action( 'wp_enqueue_scripts', 'fr_favorites_scripts');
add_action( 'wp_ajax_fr_test', 'wp_ajax_fr_test' );
?>