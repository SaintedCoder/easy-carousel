<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Log\Log;

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

// Handle subform data (video_links may be a JSON string or stdClass)
$videos = [];
if (!empty($videoLinks)) {
    // If video_links is a string (JSON), decode it
    if (is_string($videoLinks)) {
        $videoLinks = json_decode($videoLinks, true);
    }
    // Ensure video_links is an array
    if (is_array($videoLinks) || is_object($videoLinks)) {
        foreach ($videoLinks as $key => $video) {
            $url = is_object($video) ? ($video->video_url ?? '') : ($video['video_url'] ?? '');
            if (!empty($url)) {
                $url = trim($url);
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
}

// Debug: Log video URLs
Log::add('Easy Carousel Videos: ' . print_r($videos, true), Log::DEBUG, 'mod_easy_carousel');

// Pass parameters to JavaScript
$jsParams = [
    'slidesToShow' => $slidesToShow,
    'autoplay' => $autoplay
];
Factory::getDocument()->addScriptOptions('mod_easy_carousel', $jsParams);

// Load the layout
require ModuleHelper::getLayoutPath('mod_easy_carousel', $params->get('layout', 'default'));