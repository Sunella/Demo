<?php
/**
 * Categories module for HD Video Share
 *
 * This file is to fetch all the categories name in the module 
 *
 * @category   Apptha
 * @package    Mod_HDVideoShareRSS
 * @version    3.6
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Define DS
if (!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

require_once dirname(__FILE__) . DS . 'helper.php';

if (version_compare(JVERSION, '1.7.0', 'ge'))
{
	$version = '1.7';
}
elseif (version_compare(JVERSION, '1.6.0', 'ge'))
{
	$version = '1.6';
}
else
{
	$version = '1.5';
}

$class = $params->get('moduleclass_sfx');

if (version_compare(JVERSION, '1.6.0', 'ge'))
{
	$jlang = JFactory::getLanguage();
	$jlang->load('com_contushdvideoshare', JPATH_SITE, 'en-GB', true);
	$jlang->load('com_contushdvideoshare', JPATH_SITE, null, true);
}

$result = Modcategorylist::getcategorylist();
$result_settings = Modcategorylist::getcategorysettings();
$Itemid = Modcategorylist::getmenuitemid_thumb();
require JModuleHelper::getLayoutPath('mod_HDVideoShareCategories');
