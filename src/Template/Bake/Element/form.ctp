<%
use Cake\Utility\Inflector;

   $extras = [];
%>
<section class="content-header">
  <h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i></li>
        <li><%= $pluralHumanName %></li>
    </ol>
    <small><?= __('<%= $action=="add"?"Adicionar":"Editar"; %>') ?></small>
    <div class="pull-right"><?= $this->Html->link(__('Listagem'), ['action' => 'index'], ['class'=>'btn btn-success btn-sm btn-flat']) ?></div>
  </h1>
  
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($<%= $singularVar %>, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
<%
    foreach ($fields as $field) {
      if (in_array($field, $primaryKey)) {
        continue;
      }
      if (isset($keyFields[$field])) {
        $fieldData = $schema->column($field);
        if (!empty($fieldData['null'])) {
%>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true]);
<%
        } else {
%>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>]);
<%
        }
        continue;
      }
      if (!in_array($field, ['created', 'modified', 'updated'])) {
        $fieldData = $schema->column($field);
        if (($fieldData['type'] === 'date')) {
            $extras[] = 'datepicker';
%>
            echo $this->Form->input('<%= $field %>', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
<%
        } else {
%>
            echo $this->Form->input('<%= $field %>');
<%
        }
      }
    }
    if (!empty($associations['BelongsToMany'])) {
      foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
%>
            echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
<%
      }
    }
%>
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <div class="pull-right"><?= $this->Form->button(__('Salvar')) ?></div>
          </div>
        <?= $this->Form->end() ?>
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