<?php
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

require_once JPATH_COMPONENT_ADMINISTRATOR . "/helpers/rwnews.php";
require_once JPATH_ADMINISTRATOR . '/components/com_rw/helpers/rw.php';

$controller = BaseController::getInstance('rwnews');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
