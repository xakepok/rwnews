<?php
use Joomla\CMS\MVC\Controller\AdminController;
defined('_JEXEC') or die;

class RwnewsControllerCategories extends AdminController
{
    public function getModel($name = 'Category', $prefix = 'RwnewsModel', $config = array())
    {
        return parent::getModel($name, $prefix, array('ignore_request' => true));
    }
}
