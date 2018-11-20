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
    <div class="pull-right"><?= $this->Html->link(__('Adicionar'), ['action' => 'add'], ['class'=>'btn btn-success btn-sm btn-flat']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
<!--        <div class="box-header">
          <h3 class="box-title"><?= __('Listagem de') ?> <%= $pluralHumanName %></h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Pesquisar...') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filtrar') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>-->
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered"class="table table-hover">
            <thead>
              <tr>
<%  foreach ($fields as $field):
if (!in_array($field, ['modified', 'updated', 'deleted'])) :%>
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
    if (!in_array($field, ['modified', 'updated', 'deleted'])) {
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
                  <!--<?= $this->Html->link(__('Ver'), ['action' => 'view', <%= $pk %>], ['class'=>'btn btn-info btn-xs btn-flat']) ?>-->
                  <?= $this->Html->link(__('Editar'), ['action' => 'edit', <%= $pk %>], ['class'=>'btn btn-warning btn-xs btn-flat']) ?>
                  <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs btn-flat']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
