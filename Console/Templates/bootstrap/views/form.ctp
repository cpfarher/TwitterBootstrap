<div class="row-fluid">
	<div class="span12">
		<?php echo "<?php echo \$this->BootstrapForm->create('{$modelClass}', array('class' => 'form-horizontal'));?>\n";?>
			<fieldset>
				<legend><?php echo "<?php echo __('" . Inflector::humanize($action) . " %s', __('" . $singularHumanName . "')); ?>"; ?></legend>
<?php
				echo "\t\t\t\t<?php\n";
				$id = null;
				foreach ($fields as $field) {
					if (strpos($action, 'add') !== false && $field == $primaryKey) {
						continue;
					} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
						if ($field == $primaryKey) {
							$id = "\t\t\t\techo \$this->BootstrapForm->hidden('{$field}');\n";
						} else {
							if($this->templateVars['schema'][$field]['null'] == false){
								$required = ", array(\n\t\t\t\t\t'required' => 'required','class'=>'input-xxlarge',\n\t\t\t\t\t'helpInline' => '<span class=\"label label-important\">' . __('Required') . '</span>&nbsp;')\n\t\t\t\t";
							} else {
								$required = null;
							}
							echo "\t\t\t\techo \$this->BootstrapForm->input('{$field}'{$required});\n";
						}
					}
				}
				echo $id;
				unset($id);
				if (!empty($associations['hasAndBelongsToMany'])) {
					foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
						echo "\t\t\t\techo \$this->BootstrapForm->input('{$assocName}');\n";
					}
				}
				echo "\t\t\t\t?>\n";
				echo "\t\t\t\t<?php echo \$this->BootstrapForm->submit(__('Submit'));?>\n";
?>
			</fieldset>
		<?php
			echo "<?php echo \$this->BootstrapForm->end();?>\n";
		?>
	</div>
</div>