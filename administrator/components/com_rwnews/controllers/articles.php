<?php
use Joomla\CMS\MVC\Controller\AdminController;
defined('_JEXEC') or die;

class RwnewsControllerArticles extends AdminController
{
    public function getModel($name = 'Article', $prefix = 'RwnewsModel', $config = array())
    {
        return parent::getModel($name, $prefix, array('ignore_request' => true));
    }
}
