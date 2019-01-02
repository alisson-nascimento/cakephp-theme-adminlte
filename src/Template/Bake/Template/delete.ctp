<?= $this->Form->create($<%= $singularVar %>, array('role' => 'form')) ?>

<?php echo $this->Form->hidden('id')?>
<?php echo __('Deletar <%= $singularHumanName %>?') ?>

<?= $this->Form->end() ?>