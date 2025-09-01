<?php
defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;

// Load the module's CSS
HTMLHelper::_('stylesheet', 'mod_ezcarousel/style.css', ['relative' => true]);
?>

<?php if (!empty($videos)): ?>
    <div id="ezCarousel<?php echo $module->id; ?>" class="carousel slide <?php echo $moduleclass_sfx; ?>" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($videos as $index => $video): ?>
                <?php
                $url = trim($video->url ?? '');
                $provider = strtolower(trim($video->provider ?? ''));
                $videoInfo = ModEZCarouselHelper::extractVideoInfo($url, $provider);
                $videoId = $videoInfo['videoId'];
                $embedUrl = $videoInfo['embedUrl'];
                if (!$videoId || !$embedUrl) continue;
                $active = ($index === 0) ? ' active' : '';
                ?>
                <div class="carousel-item<?php echo $active; ?>">
                    <div class="video-container ratio ratio-16x9">
                        <iframe
                            src="<?php echo $embedUrl; ?>"
                            frameborder="0"
                            allowfullscreen
                            loading="lazy"
                            title="<?php echo htmlspecialchars($provider, ENT_QUOTES, 'UTF-8'); ?> video"></iframe>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#ezCarousel<?php echo $module->id; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#ezCarousel<?php echo $module->id; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php else: ?>
    <p>No videos added.</p>
<?php endif; ?>