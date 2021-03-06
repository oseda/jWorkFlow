<?php
/**
 * @package     JWorkflow
 * @subpackage  com_workflow
 *
 * @copyright   Copyright (C) 2005 - 2014 Prasit Gebsaap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class WorkflowViewDefault extends JViewLegacy
{
	/**
	 * Constructor
	 *
	 * @param   array  $config  Configuration array
	 *
	 */
	public function __construct($config = null)
	{
		$app = JFactory::getApplication();
		parent::__construct($config);
		$this->_addPath('template', $this->_basePath . '/views/default/tmpl');
		$this->_addPath('template', JPATH_THEMES . '/' . $app->getTemplate() . '/html/com_workflow/default');
	}

	/**
	 * Display the view
	 * @param   string  $tpl  Template
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Get data from the model
		$state	= $this->get('State');

		// Are there messages to display ?
		$showMessage	= false;
		if (is_object($state))
		{
			$message1		= $state->get('message');
			$message2		= $state->get('plugin_message');
			$showMessage	= ($message1 || $message2);
		}

		$this->showMessage = $showMessage;
		$this->state = &$state;

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		$canDo	= JHelperContent::getActions('com_workflow');
		JToolbarHelper::title(JText::_('COM_WORKFLOW_HEADER_' . $this->getName()), 'puzzle install');

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_workflow');
			JToolbarHelper::divider();
		}

		// Document
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_WORKFLOW_TITLE_' . $this->getName()));

		// Render side bar
		$this->sidebar = JHtmlSidebar::render();
	}
}
