<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

if (empty($videos)) {
    echo '<p>No videos configured.</p>';
    return;
}
?>

<div class="easy-carousel">
    <?php foreach ($videos as $video) : ?>
        <?php
        $embedCode = '<iframe src="' . htmlspecialchars($video, ENT_QUOTES, 'UTF-8') . '" frameborder="0" allowfullscreen></iframe>';
        if ($prepareContent) {
            $embedCode = HTMLHelper::_('content.prepare', $embedCode);
        }
        ?>
        <div class="carousel-item">
            <?php echo $embedCode; ?>
        </div>
    <?php endforeach; ?>
</div>

<style>
.easy-carousel {
    max-width: 100%;
    margin: 0 auto;
}
.carousel-item {
    padding: 10px;
}
.carousel-item iframe {
    width: 100%;
    height: 200px; /* Adjust as needed */
}
</style>