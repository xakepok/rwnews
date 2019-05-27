<?php
/**
 * @package    rwnews
 *
 * @author     anton@nazvezde.ru <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

/**
 * Rwnews helper.
 *
 * @package     A package name
 * @since       1.0
 */
class RwnewsHelper
{
	/**
	 * Render submenu.
	 *
	 * @param   string  $vName  The name of the current view.
	 *
	 * @return  void.
	 *
	 * @since   1.0
	 */
	public function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(Text::_('COM_RWNEWS'), 'index.php?option=com_rwnews&view=rwnews', $vName == 'rwnews');
	}
}
