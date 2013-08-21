<div class="row-fluid">
    <div class="span12">
        <div class="well well-small form-search">
            <?php
            echo "<?php echo \$this->BootstrapForm->create('{$modelClass}', array(
                'url' => array_merge(array('action' => 'admin_index'), \$this->params['pass']),
                'class' => 'form-inline',
            )); ?>\n"
            ?>
            <legend><?php echo "<?php echo __('" . $pluralHumanName . "'); ?>"; ?></legend>
            <fieldset>
                <?php
                echo "<?php\n";
                //  $id = null;
                foreach ($fields as $field) {
                    if ($field == $primaryKey) {
                        continue;
                    } elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                        $required = ", array(\n\t\t\t\t\t'placeholder' => __('" . 'Filter by' . " %s', __('" . $field . "')),\n\t\t\t\t\t'label' => false, 'empty' => __('" . 'Filter by' . " %s', __('" . $field . "')), 'required'=>false, 'style'=>'margin-bottom: 1%; margin-right:1%')\n\t\t\t\t";
                        echo "\t\t\t\techo \$this->BootstrapForm->input('{$field}'{$required});\n";
                    }
                }
                //  echo $id;
                //  unset($id);
                if (!empty($associations['hasAndBelongsToMany'])) {
                    foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                        echo "\t\t\t\techo \$this->BootstrapForm->input('{$assocName}');\n";
                    }
                }
                echo "?>\n";
                ?>
            </fieldset>
            <div class="form-actions">
                <?php echo "<?php echo \$this->element('filterbuttons'); ?>" ?>
                <div class="btn-group">
                    <?php echo "<?php echo \$this->Html->link(\$this->Html->tag('i', ' ', array('class' => 'icon-plus icon-user')) . '&nbsp' . __('New %s', __('" . $singularHumanName . "')), array('action' => 'add'), array('class' => 'boton-nuevo btn', 'escape' => false)); ?>" ?>;
                </div>    
            </div>
            <?php
            echo "<?= \$this->BootstrapForm->end(); ?>";
            ?>   

        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <table class="table table-condensed table-striped table-hover">
            <tr>
                <?php foreach ($fields as $field): ?>
<th><?php echo "<?php echo \$this->BootstrapPaginator->sort('{$field}');?>"; ?></th>
                <?php endforeach; ?>
                <th class="actions"><?php echo "<?php echo __('Actions');?>"; ?></th>
            </tr>
            <?php
            echo "\t\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
            echo "\t\t\t<tr>\n";
            foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['belongsTo'])) {
                    foreach ($associations['belongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            echo "\t\t\t\t<td>\n\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t</td>\n";
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    echo "\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                }
            }

            echo "\t\t\t\t<td class=\"\"><div class=\"btn-group\">\n";
            echo "<a class=\"btn btn-info dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"\><i class=\"icon-wrench icon-white\"></i> Acciones<span class=\"caret\"></span></a>"; // agrego acciones link
            echo "<ul class=\"dropdown-menu\">";

            echo "\t\t\t\t\t <li><?php echo \$this->Html->link(\$this->Html->tag('i', '', array('class' => 'icon-eye-open')).__('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?></li>\n";
            echo "\t\t\t\t\t <li><?php echo \$this->Html->link(\$this->Html->tag('i', '', array('class' => 'icon-edit')).__('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?></li>\n";
            echo "\t\t\t\t\t <li><?php echo\$this->Form->postLink(\$this->Html->tag('i', '', array('class' => 'icon-trash')).__('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?></li>\n";

            echo "\t\t\t\t</ul></div></td>\n";
            echo "\t\t\t</tr>\n";

            echo "\t\t<?php endforeach; ?>\n";
            ?>
        </table>
        <p>
            <?php echo "<?php echo \$this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>\n"; ?>
        </p>

        <?php echo "<?php echo \$this->BootstrapPaginator->pagination(); ?>\n"; ?>
    </div>
</div>