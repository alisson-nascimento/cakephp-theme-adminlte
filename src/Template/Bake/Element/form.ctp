<%
use Cake\Utility\Inflector;

$extras = [];
%>
<section class="content-header">
    <h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i></li>
            <li><?= __('<%= $pluralHumanName %>') ?></li>
        </ol>
        <small><?= ($this->request->params['action'] == 'edit')? __('Editar'): __('Adicionar') ?></small>
        <div class="pull-right"><?= $this->Html->link(__('Listagem'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat']) ?></div>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1" data-toggle="tab" aria-expanded="true"><b><?=__('<%= ucfirst($singularHumanName) %>')?></b></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                    <?= $this->Form->create($<%= $singularVar %>, array('role' => 'form')) ?>

                      <?php
            <%
                foreach ($fields as $field) {
                  if (in_array($field, $primaryKey)) {
                    continue;
                  }
                  if (isset($keyFields[$field])) {
                    $fieldData = $schema->getColumn($field);
                    if (!empty($fieldData['null'])) {
            %>
                        echo $this->Form->input('<%= $field %>', ['label'=>__('<%= ucfirst($field) %>'),'options' => $<%= $keyFields[$field] %>, 'empty' => true]);
            <%
                    } else {
            %>
                        echo $this->Form->input('<%= $field %>', ['label'=>__('<%= ucfirst($field) %>'),'options' => $<%= $keyFields[$field] %>]);
            <%
                    }
                    continue;
                  }
                  if (!in_array($field, ['created', 'modified', 'updated', 'deleted'])) {
                    $fieldData = $schema->getColumn($field);
                    if (($fieldData['type'] === 'date')) {
                        $extras[] = 'datepicker';
            %>
                        echo $this->Form->input('<%= $field %>', ['label'=>__('<%= ucfirst($field) %>'),'empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
            <%
                    } else {
            %>
                        echo $this->Form->input('<%= $field %>', ['label'=>__('<%= ucfirst($field) %>')]);
            <%
                    }
                  }
                }
                if (!empty($associations['BelongsToMany'])) {
                  foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
            %>
                        echo $this->Form->input('<%= $assocData['property'] %>._ids', ['label'=>__('<%= ucfirst($field) %>'), 'options' => $<%= $assocData['variable'] %>]);
            <%
                  }
                }
            %>
                      ?>
                        <div class="tab-footer">
                            <div class="pull-right"><?= $this->Form->button(__('Salvar')) ?></div>
                        </div>
                        <?= $this->Form->end() ?>
                    
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>

<%
if (!empty($extras)) {
foreach($extras as $element) {
%>
<% echo $this->element($element); %>
<%
}
}
%>