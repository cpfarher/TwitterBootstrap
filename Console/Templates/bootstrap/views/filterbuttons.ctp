<?php
echo $this->BootstrapForm->submit($this->Html->tag('i', ' ', array('class' => 'icon-filter icon-white')) . ' ' . __('Search', true), array('div' => false, 'class' => 'btn btn-primary  pull-right'));
echo $this->Html->link($this->Html->tag('i', ' ', array('class' => 'icon-ban-circle')) . ' ' . __('View All', true), array('action' => 'index'), array('class' => 'limpiar-filtro btn  pull-right', 'escape' => false));
?>