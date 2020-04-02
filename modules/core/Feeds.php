<?php

namespace Tweakr;

class Feeds{

    public static function throwError(){
        // redirect to home
        wp_redirect(home_url(), 302);
        exit();
    }

    public static function disableRSS(){
        add_action('do_feed_rss', array('Tweakr\Feeds', 'throwError'), 1);
        add_action('do_feed_rss2', array('Tweakr\Feeds', 'throwError'), 1);
        add_action('do_feed_rss2_comments', array('Tweakr\Feeds', 'throwError'), 1);
    }

    public static function disableAtom(){
        add_action('do_feed_atom', array('Tweakr\Feeds', 'throwError'), 1);
        add_action('do_feed_atom_comments', array('Tweakr\Feeds', 'throwError'), 1);
    }

    public static function disableRDF(){
        add_action('do_feed_rdf', array('Tweakr\Feeds', 'throwError'), 1);
    }

    // hide feed links
    public static function hideFeedLinks(){
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}