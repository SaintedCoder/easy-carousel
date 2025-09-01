<?php
defined('_JEXEC') or die;

class ModEZCarouselHelper
{
    public static function extractVideoInfo($url, $provider)
    {
        $url = trim($url);
        $provider = strtolower($provider);
        $videoId = null;
        $embedUrl = '';

        switch ($provider) {
            case 'youtube':
                if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                }
                if ($videoId) {
                    $embedUrl = "https://www.youtube.com/embed/$videoId";
                }
                break;

            case 'vimeo':
                if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                } elseif (preg_match('/vimeo\.com\/video\/([0-9]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                }
                if ($videoId) {
                    $embedUrl = "https://player.vimeo.com/video/$videoId";
                }
                break;

            case 'rumble':
                if (preg_match('/rumble\.com\/v([^\-\?\/]+)-/', $url, $matches)) {
                    $videoId = $matches[1];
                } elseif (preg_match('/rumble\.com\/embed\/v([^\&\?\/]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                }
                if ($videoId) {
                    $embedUrl = "https://rumble.com/embed/v$videoId";
                }
                break;

            case 'dailymotion':
                if (preg_match('/dailymotion\.com\/video\/([^\&\?\/_]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                } elseif (preg_match('/dai\.ly\/([^\&\?\/]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                }
                if ($videoId) {
                    $embedUrl = "https://www.dailymotion.com/embed/video/$videoId";
                }
                break;
        }

        return ['videoId' => $videoId, 'embedUrl' => $embedUrl];
    }
}