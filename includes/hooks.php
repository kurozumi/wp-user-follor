<?php

add_action( 'wp_ajax_wuf-follow',   'wuf_ajax_follow'   );
add_action( 'wp_ajax_wuf-unfollow', 'wuf_ajax_unfollow' );

add_action( 'wp_enqueue_scripts', 'wuf_enqueue_scripts' );