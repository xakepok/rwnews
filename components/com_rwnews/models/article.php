<?php
use Joomla\CMS\MVC\Model\ItemModel;

defined('_JEXEC') or die;

class RwnewsModelArticle extends ItemModel
{
    public function __construct($config = array())
    {
        $this->id = JFactory::getApplication()->input->getInt('id', 0);
        parent::__construct($config);
    }

    public function getTable($name = 'Rwnews', $prefix = 'TableRwnews', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }

    public function getItem(): object
    {
        $table = $this->getTable();
        $table->load($this->id);
        $table->image = (!JFactory::getApplication()->client->mobile) ? $table->img_full : $table->img_prev;
        $links = array();
        $attribs = array('target' => '_blank');
        if ($table->link_original != null) $links['original'] = JHtml::link($table->link_original, JText::sprintf('COM_RWNEWS_ARTICLE_LINK_ORIGINAL'), $attribs);
        if ($table->link_group != null) $links['group'] = JHtml::link($table->link_group, JText::sprintf('COM_RWNEWS_ARTICLE_LINK_GROUP'), $attribs);
        $table->links = implode(' / ', $links);
        $table->assets = implode(' / ', $this->getAssets());
        return $table;
    }

    private function getAssets(): array
    {
        $assets = array();
        $stations = RwnewsHelper::getNewsStations($this->id, true);
        foreach ($stations as $station) {
            $assets[] = JHtml::link(JRoute::_("index.php?option=com_rw&amp;view=station&amp;id={$station['stationID']}"), $station['title']);
        }
        $directions = RwnewsHelper::getNewsDirections($this->id, true);
        foreach ($directions as $direction) {
            $assets[] = JHtml::link(JRoute::_("index.php?option=com_rw&amp;view=direction&amp;id={$direction['directionID']}"), JText::sprintf('COM_RWNEWS_ARTICLE_LINK_DIRECTION_NAME', $direction['title']));
        }
        return $assets;
    }

    public $id;
}
