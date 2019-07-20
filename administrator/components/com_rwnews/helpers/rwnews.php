<?php

defined('_JEXEC') or die;

class RwnewsHelper
{
	public function addSubmenu($vName)
	{
        JHtmlSidebar::addEntry(JText::sprintf('COM_RWNEWS_MENU_NEWS'), 'index.php?option=com_rwnews&view=articles', $vName == 'articles');
        JHtmlSidebar::addEntry(JText::sprintf('COM_RWNEWS_MENU_THEMES'), 'index.php?option=com_rwnews&view=themes', $vName == 'themes');
        JHtmlSidebar::addEntry(JText::sprintf('COM_RWNEWS_MENU_CATEGORIES'), 'index.php?option=com_rwnews&view=categories', $vName == 'categories');
	}

    public static function isMobile(): bool
    {
        return JFactory::getApplication()->client->mobile;
	}

    /**
     * Возвращает массив станций, к которым привязана новость
     * @param int $newsID ID новости
     * @param bool $full отображать полную информацию о станции
     * @return array
     * @since version 1.0.0.2
     */
    public static function getNewsStations(int $newsID = 0, bool $full = false): array
    {
        if ($newsID == 0) return array();
        $db =& JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("ns.stationID")
            ->from("`#__rwnews_stations` ns")
            ->where("`newsID` = {$newsID}");
        if (!$full) {
            return $db->setQuery($query)->loadColumn() ?? array();
        }
        else
        {
            $query
                ->select("s.title")
                ->leftJoin("`#__rw_stations` s on s.id=ns.stationID");
            return $db->setQuery($query)->loadAssocList() ?? array();
        }
	}

    /**
     * Возвращает массив направлений, к которым привязана новость
     * @param int $newsID ID новости
     * @param bool $full отображать полную информацию о направлении
     * @return array
     * @since version 1.0.0.4
     */
    public static function getNewsDirections(int $newsID = 0, bool $full = false): array
    {
        if ($newsID == 0) return array();
        $db =& JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("nd.directionID")
            ->from("`#__rwnews_directions` nd")
            ->where("`newsID` = {$newsID}");
        if (!$full) {
            return $db->setQuery($query)->loadColumn() ?? array();
        }
        else
        {
            $query
                ->select("d.title")
                ->leftJoin("`#__rw_directions` d on d.id=nd.directionID");
            return $db->setQuery($query)->loadAssocList() ?? array();
        }
	}

    public static function getParam(string $param, string $default = null, string $option = 'com_rwnews')
    {
        $config = JComponentHelper::getParams($option);
        return $config->get($param, $default);
	}

    /**
     * Возвращает URL для обработки формы
     * @return string
     * @since 1.0.0.1
     * @throws
     */
    public static function getActionUrl(): string
    {
        $uri = JUri::getInstance();
        $query = $uri->getQuery();
        $client = (!JFactory::getApplication()->isClient('administrator')) ? 'site' : 'administrator';
        return JRoute::link($client, "index.php?{$query}");
    }

    /**
     * Возвращает текущий URL
     * @return string
     * @since 1.0.0.1
     * @throws
     */
    public static function getCurrentUrl(): string
    {
        $uri = JUri::getInstance();
        $query = $uri->getQuery();
        return "index.php?{$query}";
    }

    /**
     * Возвращает URL для возврата (текущий адрес страницы)
     * @return string
     * @since 1.0.0.1
     */
    public static function getReturnUrl(): string
    {
        $uri = JUri::getInstance();
        $query = $uri->getQuery();
        return base64_encode("index.php?{$query}");
    }

    /**
     * Возвращает URL для обработки формы левой панели
     * @return string
     * @since 1.0.0.1
     */
    public static function getSidebarAction():string
    {
        $return = self::getReturnUrl();
        return JRoute::_("index.php?return={$return}");
    }

    /**
     * Возвращает права доступа текущего пользователя
     * @param string $action требуемое право для проверки доступа
     * @return bool
     * @since 1.0.0.1
     */
    public static function canDo(string $action): bool
    {
        return JFactory::getUser()->authorise($action, 'com_rwnews');
    }

}
