<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;

require_once __DIR__ . '/helper.php';

// Load Bootstrap framework
HTMLHelper::_('bootstrap.framework');

$videos = (array) $params->get('videos', []);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

require ModuleHelper::getLayoutPath('mod_ezcarousel', $params->get('layout', 'default'));