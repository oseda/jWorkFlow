<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

/**
 * Workflow view.
 *
 * @package     Workflow
 * @subpackage  com_workflow
 * @since       1.0
 */
class WorkflowViewPlugins extends JViewLegacy
{
	/**
	 * @var    array  The array of records to display in the list.
	 * @since  1.0
	 */
	protected $items;

	/**
	 * @var    JPagination  The pagination object for the list.
	 * @since  1.0
	 */
	protected $pagination;

	/**
	 * @var    JObject	The model state.
	 * @since  1.0
	 */
	protected $state;

	/**
	 * Prepare and display the Plugins view.
	 *
	 * @return  void
	 * @since   1.0
	 */
	public function display($tp = NULL)
	{
		// Initialise variables.
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Add the toolbar if it is not in modal
		if ($this->getLayout() !== 'modal') {
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
		}
		
		// Display the view layout.
		parent::display();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 * @since   1.0
	 */
	protected function addToolbar()
	{
		// Initialise variables.
		$state	= $this->get('State');
		$canDo	= WorkflowHelper::getActions();

		JToolBarHelper::title(JText::_('COM_WORKFLOW_PLUGINS_TITLE'));

		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('plugin.edit', 'JTOOLBAR_EDIT');
		}
		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::publishList('plugins.publish', 'JTOOLBAR_PUBLISH');
			JToolBarHelper::unpublishList('plugins.unpublish', 'JTOOLBAR_UNPUBLISH');
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'plugins.delete','JTOOLBAR_DELETE');
		} 

	}
}