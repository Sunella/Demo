<?php
/**
 * @name       Joomla HD Video Share
 * @SVN        3.5.1
 * @package    Com_Contushdvideoshare
 * @author     Apptha <assist@apptha.com>
 * @copyright  Copyright (C) 2014 Powered by Apptha
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @since      Joomla 1.5
 * @Creation Date   March 2010
 * @Modified Date   March 2014
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import joomla controller library
jimport('joomla.application.component.controller');

/**
 * Admin memberdetails controller class.
 *
 * @package     Joomla.Contus_HD_Video_Share
 * @subpackage  Com_Contushdvideoshare
 * @since       1.5
 */
class ContushdvideoshareControllermemberdetails extends ContusvideoshareController
{
	/**
	 * Function to set layout and model for view page.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   boolean  $urlparams  An array of safe url parameters and their variable types
	 *
	 * @return  ContushdvideoshareControllermemberdetails		This object to support chaining.
	 * 
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$viewName = JRequest::getVar('view', 'memberdetails');
		$viewLayout = JRequest::getVar('layout', 'memberdetails');
		$view = $this->getView($viewName);

		if ($model = $this->getModel('memberdetails'))
		{
			$view->setModel($model, true);
		}

		$view->setLayout($viewLayout);
		$view->display();
	}

	/** 
	 * Function to publish memberdetails 
	 * 
	 * @return  publish
	 */
	public function publish()
	{
		$detail = JRequest::get('POST');
		$model = $this->getModel('memberdetails');
		$model->memberActivation($detail);
		$this->setRedirect('index.php?layout=memberdetails&option=' . JRequest::getVar('option'));
	}

	/** 
	 * Function to unpublish memberdetails 
	 * 
	 * @return  unpublish
	 */
	public function unpublish()
	{
		$detail = JRequest::get('POST');
		$model = $this->getModel('memberdetails');
		$model->memberActivation($detail);
		$this->setRedirect('index.php?layout=memberdetails&option=' . JRequest::getVar('option'));
	}

	/** 
	 * Function to allowupload memberdetails
	 * 
	 * @return  allowupload
	 */
	public function allowupload()
	{
		$detail = JRequest::get('POST');
		$model = $this->getModel('memberdetails');
		$model->allowUpload($detail);
		$this->setRedirect('index.php?layout=memberdetails&option=' . JRequest::getVar('option'));
	}

	/** 
	 * Function to unallowupload memberdetails
	 * 
	 * @return  unallowupload
	 */
	public function unallowupload()
	{
		$detail = JRequest::get('POST');
		$model = $this->getModel('memberdetails');
		$model->allowUpload($detail);
		$this->setRedirect('index.php?layout=memberdetails&option=' . JRequest::getVar('option'));
	}
}
