<?php
/**
 * Category module for HD Video Share
 *
 * This file is to fetch the particular category details
 *
 * @category   Apptha
 * @package    Mod_HDVideoShareRSS
 * @version    3.6
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2014 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

// Define DS
if (!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

// Include the model file
require_once (dirname ( __FILE__ ) . DS . 'helper.php');
$document = JFactory::getDocument();

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
	$document->addStyleSheet(JURI::base() . 'components/com_contushdvideoshare/css/tool_tip_15.css');
}

if (version_compare(JVERSION, '1.6.0', 'ge'))
{
	$jlang = JFactory::getLanguage();
	$jlang->load('mod_HDVideoShareFeatured', JPATH_SITE, $jlang->get('tag'), true);
	$jlang->load('mod_HDVideoShareFeatured', JPATH_SITE, null, true);
}

$class 			= $params->get('moduleclass_sfx');
$catid			= $params->get ( 'catid' );
$Itemid 		= Modvideosharecategory::getmenuitemid_thumb();
$result 		= Modvideosharecategory::getcategoryVideos($catid);
$result1 		= Modvideosharecategory::getcategoryVideossettings();

// To display the html layout path
require JModuleHelper::getLayoutPath ( 'mod_HDVideoShareCategory' );
