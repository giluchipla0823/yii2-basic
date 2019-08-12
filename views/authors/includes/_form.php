<?php
use yii\helpers\Html;
use app\libraries\DetailView;
?>
<div class="authors-view">
    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => TRUE,
        'hover' => TRUE,
        'mode' => $mode,
        'panel' => [
            'heading' => $title,
            'type' => DetailView::TYPE_DEFAULT,
        ],
        'attributes' => [
            [
                'label' => 'id',
                'attribute' => 'id',
                'visible' => $mode === DetailView::MODE_VIEW,
                'options' => ['readonly' => ($mode === DetailView::MODE_EDIT)],
            ],
            [
                'label' => 'Nombres',
                'attribute' => 'name',
            ],
            [
                'label' => 'Estado',
                'attribute' => 'active',
                'value' => call_user_func(function ($model) {
                    if($model->active === 1){
                        return Html::tag('span', 'Habilitado', ['class' => 'label label-success']);
                    }

                    return Html::tag('span', 'Deshabilitado', ['class' => 'label label-danger']);

                }, $model),
                'format' => 'raw',
                'type' => DetailView::INPUT_SWITCH,
                'widgetOptions'=>[
                    'pluginOptions'=>[
                        'onText' => 'Si',
                        'offText' => 'No',
                        'onColor' => 'success',
                        'offColor' => 'danger'
                    ]
                ]
            ]
        ]
    ]);
    ?>
</div>

</div>
