<%
use Cake\Utility\Inflector;

$fields = collection($fields)
  ->filter(function($field) use ($schema) {
    return !in_array($schema->columnType($field), ['binary', 'text']);
  })
  ->take(7);
%>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i></li>
        <li><%= $pluralHumanName %></li>
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
if (!in_array($field, ['modified', 'updated', 'deleted', 'id'])) :%>
                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
<%  endif; %>
<%  endforeach; %>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
              <tr>
<%  foreach ($fields as $field) {
    if (!in_array($field, ['modified', 'updated', 'deleted', 'id'])) {
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
      if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
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
                  <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs btn-flat']) ?>
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
