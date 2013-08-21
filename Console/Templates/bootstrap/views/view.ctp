<div class="row-fluid">
    <div class="span9 well well-small">
        <legend><?php echo "<?php  echo __('{$singularHumanName}');?>"; ?></legend>
        <dl>
            <?php
            foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['belongsTo'])) {
                    foreach ($associations['belongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            echo "\t\t\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
                            echo "\t\t\t<dd>\n\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t&nbsp;\n\t\t\t</dd>\n";
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    echo "\t\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
                    echo "\t\t\t<dd>\n\t\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t&nbsp;\n\t\t\t</dd>\n";
                }
            }
            ?>
        </dl>
    </div>

    <div class="span3">
        <div class="well" style="padding: 8px 0; margin-top:8px;">
            <ul class="nav nav-list">
                <li class="nav-header"><?php echo "<?php echo __('Actions'); ?>"; ?></li>
                <?php
                echo "\t\t\t<li><?php echo \$this->Html->link(__('Edit %s', __('" . $singularHumanName . "')), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
                echo "\t\t\t<li><?php echo \$this->Form->postLink(__('Delete %s', __('" . $singularHumanName . "')), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
                echo "\t\t\t<li><?php echo \$this->Html->link(__('List %s', __('" . $pluralHumanName . "')), array('action' => 'index')); ?> </li>\n";
                echo "\t\t\t<li><?php echo \$this->Html->link(__('New %s', __('" . $singularHumanName . "')), array('action' => 'add')); ?> </li>\n";

                $done = array();
                foreach ($associations as $type => $data) {
                    foreach ($data as $alias => $details) {
                        if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                            echo "\t\t\t<li><?php echo \$this->Html->link(__('List %s', __('" . Inflector::humanize($details['controller']) . "')), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
                            echo "\t\t\t<li><?php echo \$this->Html->link(__('New %s', __('" . Inflector::humanize(Inflector::underscore($alias)) . "')), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
                            $done[] = $details['controller'];
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>