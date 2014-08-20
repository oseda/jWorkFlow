<?php
echo JHtml::_('sliders.panel',JText::_('COM_WORKFLOW_FIELDSET_TRIGGER_CONFIG'), 'triggerform-config');

?>
	<fieldset class="panelform">
		<ul class="adminformlist">
	<?php if ($this->item->id) : ?>
		<?php foreach ($this->form->getFieldset('trigger_config') as $field) : ?>
			<li>
				<?php echo $field->label; ?>
				<?php echo $field->input; ?>
			</li>
		<?php endforeach; ?>
	<?php else : ?>
		<?php echo JText::_('COM_WORKFLOW_TRIGGER_CONFIG_AFTER_SAVE') ?>	
	<?php endif;?>	
		</ul>
	</fieldset>
