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
        if ($table->link_original != null) {
            $links['original'] = array('url' => $table->link_original, 'text' => JText::sprintf('COM_RWNEWS_ARTICLE_LINK_ORIGINAL'));
        }
        if ($table->link_group != null) {
            $links['group'] = array('url' => $table->link_group, 'text' => JText::sprintf('COM_RWNEWS_ARTICLE_LINK_GROUP'));
        }
        $table->links = $links;
        $table->assets = $this->getAssets();
        return $table;
    }

    private function getAssets(): array
    {
        $assets = array();
        $stations = RwnewsHelper::getNewsStations($this->id, true);
        $itemID = RwHelper::getMenuItemId('station');
        foreach ($stations as $station) {
            $assets[] = array(
                'url' => JRoute::_("index.php?option=com_rw&amp;view=station&amp;id={$station['stationID']}&amp;Itemid={$itemID}"),
                'text' => $station['title']
            );
        }
        $directions = RwnewsHelper::getNewsDirections($this->id, true);
        $itemID = RwHelper::getMenuItemId('direction');
        foreach ($directions as $direction) {
            $assets[] = array(
                'url' => JRoute::_("index.php?option=com_rw&amp;view=direction&amp;id={$direction['directionID']}&amp;Itemid={$itemID}"),
                'text' => JText::sprintf('COM_RWNEWS_ARTICLE_LINK_DIRECTION_NAME', $direction['title'])
            );
        }
        return $assets;
    }

    public $id;
}
