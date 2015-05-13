<?php

#################################
##          OneClickMoney      ## 
##    http://oneclickmoney.ru  ##
##     13.05.2015, 14:35:15    ##
##  author: Victor Shumeyko    ##
##  Предназначение :           ##
#################################
use yii\helpers\Html;
$this->title = 'Список баннеров';
$this->params['breadcrumbs'][] = ['label'=>'Баннеры','url'=>'/admin/banner/'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Список баннеров
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-10 col-lg-10 col-md-10 col-xs-10">
                            </div>
                            <div class="col-sm-2 col-lg-2 col-md-2 col-xs-2 text-right">
                                <div class="dataTables_filter dataTables_length">
                                    <!--<button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Добавить</button>-->
                                    <?= Html::a('<i class="fa fa-plus-circle"></i> Добавить', ['/admin/banner/add/'], ['class'=>'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                                    <thead>
                                        <tr role="row">
                                            <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" class="col-lg-1 col-sm-1 col-xs-1 col-md-1">#</th>
                                            <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1">Описание</th>
                                            <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1">Ссылка</th>
                                            <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1">Статус</th>
                                            <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1">Действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                         <?php foreach ($banners as $banner) { ?>
                                            <tr class="gradeA odd" role="row">
                                                <td class=""><?=$banner->id?></td>
                                                <td><?=$banner->description?></td>
                                                <td><?=$banner->url?></td>
                                                <td class="center sorting_1"><?=$banner->status?></td>
                                                <td class="center"><?php echo Html::a('Редактировать',['/admin/banner/edit/id/'.$banner->id])?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Показано с <?=$offset?> по <?=$limit+$offset?> из <?=$count?> записей</div>
                                    
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                    <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pagination,]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>