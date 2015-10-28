
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUTHORIZONTAL,
)); ?>
 
<fieldset>
 
    <legend>Legend</legend>
 
    <?php echo $form->textFieldControlGroup($model, 'textField',
        array('help' => 'In addition to freeform text, any HTML5 text-based input appears like so.')); ?>
    <?php echo $form->dropDownListControlGroup($model, 'dropDown',
        array('1', '2', '3', '4', '5'), array('empty' => 'Something...')); ?>
    <?php echo $form->dropDownListControlGroup($model, 'multiDropDown',
        array('1', '2', '3', '4', '5'), array('multiple' => true)); ?>
    <?php echo $form->fileFieldControlGroup($model, 'fileField'); ?>
    <?php echo $form->textAreaControlGroup($model, 'textArea',
        array('span' => 8, 'rows' => 5)); ?>
    <?php echo $form->uneditableFieldControlGroup($model, 'uneditableField'); ?>
    <?php echo $form->textFieldControlGroup($model, 'disabled', array('disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'prepend', array('prepend' => '@')); ?>
    <?php echo $form->textFieldControlGroup($model, 'append', array('append' => '.00')); ?>
    <?php echo $form->checkBoxControlGroup($model, 'disabledCheckbox', array('disabled' => true)); ?>
    <?php echo $form->inlineCheckBoxListControlGroup($model, 'inlineCheckboxes', array('1', '2', '3')); ?>
    <?php echo $form->checkBoxListControlGroup($model, 'checkboxes', array(
        'Option one is this and that—be sure to include why it\'s great',
        'Option two can also be checked and included in form results',
        'Option three can—yes, you guessed it—also be checked and included in form results',
    ), array('help' => '<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>
    <?php echo $form->radioButtonControlGroup($model, 'radioButton'); ?>
    <?php echo $form->radioButtonListControlGroup($model, 'radioButtons', array(
        'Option one is this and that—be sure to include why it\'s great',
        'Option two can is something else and selecting it will deselect option one',
    )); ?>
 
</fieldset>
