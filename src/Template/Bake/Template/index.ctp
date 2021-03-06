<%
use Cake\Utility\Inflector;

$fields = collection($fields)
  ->filter(function($field) use ($schema) {
    return !in_array($schema->getColumnType($field), ['binary', 'text']);
  })
  ->take(7);
%>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i></li>
        <li><?= __('<%= $pluralHumanName %>')?></li>
    </ol>
    <small>Listagem</small>
    <div class="pull-right"><?= $this->Html->link(__('Adicionar'), ['action' => 'add'], ['class'=>'btn btn-default btn-sm btn-flat']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      
      <!-- Perquisar -->
      <?php echo $this->element('AdminLTE.filter'); ?>
        
      <div class="box">
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered"class="table table-hover">
            <thead>
              <tr>
<%  foreach ($fields as $field):
$fieldUcFirst = ucfirst($field);
if (!in_array($field, ['created', 'modified', 'deleted', 'id'])) :%>
                <th><?= $this->Paginator->sort('<%= $field %>', __('<%= $fieldUcFirst %>')) ?></th>
<%  endif; %>
<%  endforeach; %>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
              <tr>
<%  foreach ($fields as $field) {
    if (!in_array($field, ['modified', 'created', 'deleted', 'id'])) {
    $isKey = false;
    if (!empty($associations['BelongsTo'])) {
    foreach ($associations['BelongsTo'] as $alias => $details) {
      if ($field === $details['foreignKey']) {
        $isKey = true;
%>
                <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
<%
          break;
        }
      }
    }

    if ($isKey !== true) {
      if (!in_array($schema->getColumnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
                <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
      } else {
%>
                <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
      }
    }
    }
  }
  $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
                <td class="actions" style="white-space:nowrap">
                  <!--<?= $this->Html->link(__('Ver'), ['action' => 'view', <%= $pk %>], ['class'=>'btn btn-default btn-xs btn-flat']) ?>-->
                  <?= $this->Html->link(__('Editar'), ['action' => 'edit', <%= $pk %>], ['class'=>'btn btn-default btn-xs btn-flat']) ?>
                  <?= $this->Html->link(__('Deletar'), ['action' => 'delete', <%= $pk %>], ['class'=>'btn btn-danger btn-xs btn-flat modal-delete']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <div class='pull-left'>
             <?php  echo $this->Paginator->counter(
                    '{{start}} - {{end}} de {{count}}'
                    );?>
            </div>  
            <ul class="pagination pagination-sm no-margin pull-right">
              <?php echo $this->Paginator->numbers(['first' => __('Primeira'), 'last'=>__('Última')]); ?>
            </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
<?php
  $this->Html->script('_modal',  ['block' => true]);
?>
