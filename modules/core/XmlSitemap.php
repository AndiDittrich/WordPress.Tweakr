<?php

namespace Tweakr;

use DateTime;
use DateTimeZone;

class XmlSitemap{

    public function __construct($virtualPageManager){
        // register page
        $virtualPageManager->registerPage('xml_sitemap', '^sitemap\.xml(.*?)/?$', array($this, 'render'));
    }

    // Generate XML Sitemap
    // @see https://www.sitemaps.org/de/protocol.html
    public function render(){
        // set content type
        header('Content-type: text/xml');

        // generate xml
        echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', "\n";

        // add frontpage
        $this->renderItem(home_url(), null, 0.9);

        // get posts + pages (lowlevel)
        $posts = $this->getPosts();
        $tz = new DateTimeZone('UTC');
        foreach ($posts as $post){
            // create new entry
            $this->renderItem(get_permalink($post->ID), DateTime::createFromFormat('Y-m-d H:i:s', $post->post_modified_gmt, $tz));
        }

        echo '</urlset>';
    }

    // generate xml entry for a single item
    private function renderItem($link, $lastModified=null, $priority=null, $changeFreq=null){
        echo '<url>';
        echo '<loc>', trim(htmlspecialchars($link, ENT_XML1 | ENT_COMPAT, 'UTF-8')), '</loc>';

        // last modified set ?
        if ($lastModified){
            echo '<lastmod>', htmlspecialchars($lastModified->format(DateTime::W3C), ENT_XML1 | ENT_COMPAT, 'UTF-8'),'</lastmod>';
        }

        // priority set ?
        if ($priority){
            echo '<priority>', floatval($priority), '</priority>';
        }
        
        echo '</url>', "\n";
    }

    // fetch posts+pages (performance)
    private function getPosts(){
        global $wpdb;

        // fetch post_id and last modified
        // ignore password protected pages
        // ignore other types
        return $wpdb->get_results('SELECT `ID`, `post_modified_gmt` '
                           . ' FROM ' . $wpdb->posts
                           . ' WHERE `post_status` = \'publish\''
                           . ' AND (`post_type` = \'post\' OR `post_type` = \'page\')'
                           . ' AND `post_password` = \'\''
                           . ' ORDER BY `ID` DESC;');
    }

}