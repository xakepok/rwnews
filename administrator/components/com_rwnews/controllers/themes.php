<?php
use Joomla\CMS\MVC\Controller\AdminController;
defined('_JEXEC') or die;

class RwnewsControllerThemes extends AdminController
{
    public function getModel($name = 'Theme', $prefix = 'RwnewsModel', $config = array())
    {
        return parent::getModel($name, $prefix, array('ignore_request' => true));
    }
}
