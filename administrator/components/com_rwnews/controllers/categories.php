<?php
use Joomla\CMS\MVC\Controller\AdminController;
defined('_JEXEC') or die;

class RwControllerCategories extends AdminController
{
    public function getModel($name = 'Category', $prefix = 'RwModel', $config = array())
    {
        return parent::getModel($name, $prefix, array('ignore_request' => true));
    }
}
