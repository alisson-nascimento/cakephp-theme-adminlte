<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse1" aria-expanded="true">
                <b>Pesquisar</b>
            </a>
            <div class="pull-right">
                <?= $this->Form->button(__('Filtrar'), ['class' => 'btn btn-default btn-xs btn-flat']) ?>
                <!-- Split button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-flat btn-xs"><?=__('Exportar')?></button>
                    <button type="button" class="btn btn-default dbtn-flat btn-xs ropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?=__('PDF')?></a></li>
                        <li><a href="#"><?=__('XLS')?></a></li>
                    </ul>
                </div>
            </div>  
        </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
            <?= $this->Form->create(null, array('role' => 'form')) ?>

            <?php
            echo $this->Form->input('query');
            ?>

            <?= $this->Form->end() ?>
        </div>      
    </div>
</div>  