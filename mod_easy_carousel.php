<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;

// Load jQuery
HTMLHelper::_('jquery.framework');

// Load Slick Slider and module scripts
HTMLHelper::_('script', 'mod_easy_carousel/js/slick.min.js', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('stylesheet', 'mod_easy_carousel/css/slick.css', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('stylesheet', 'mod_easy_carousel/css/slick-theme.css', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('script', 'mod_easy_carousel/js/easy-carousel.js', ['version' => 'auto', 'relative' => true]);

// Get module parameters
$videoLinks = $params->get('video_links', []);
$slidesToShow = (int) $params->get('slides_to_show', 3);
$autoplay = (bool) $params->get('autoplay', 1);
$prepareContent = (bool) $params->get('prepare_content', 1);

// Process video URLs to embed format
$videos = [];
if (!empty(INFO: $videoLinks)) {
    foreach ($videoLinks as $video) {
        if (!empty($video->video_url)) {
            $url = trim($video->video_url);
            // Convert YouTube URLs
            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
                $url = 'https://www.youtube.com/embed/' . $matches[1];
            } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
                $url = 'https://www.youtube.com/embed/' . $matches[1];
            } elseif (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
                $url = 'https://player.vimeo.com/video/' . $matches[1];
            }
            $videos[] = $url;
        }
    }
}

// Pass parameters to JavaScript
$jsParams = [
    'slidesToShow' => $slidesToShow,
    'autoplay' => $autoplay
];
Factory::getDocument()->addScriptOptions('mod_easy_carousel', $jsParams);

// Debug: Log video URLs
JLog::add('Easy Carousel Videos: ' . print_r($videos, true), JLog::DEBUG, 'mod_easy_carousel');

// Load the layout
require ModuleHelper::getLayoutPath('mod_easy_carousel', $params->get('layout', 'default'));