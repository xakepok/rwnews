<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\FormController;

class RwnewsControllerTheme extends FormController {
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }
}