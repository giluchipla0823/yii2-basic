<?php
use yii\helpers\Html;
use kartik\detail\DetailView;

?>
<div class="country-view">
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
            'code',
            'name',
            'population'
        ],
        'buttons1' =>
            Html::a(
                '<i class="glyphicon glyphicon-pencil"></i>',
                [
                    'update',
                    'id' => $model->id
                ],
                [
                    'class' => 'kv-action-btn',
                    'data-toggle' => "tooltip",
                    'data-container' => 'body',
                    'data-original-title' => 'Update'
                ]
            )
           . Html::a(
                '<i class="glyphicon glyphicon-trash"></i>',
                [
                    'delete',
                    'id' => $model->id
                ],
                [
                    'class' => 'kv-action-btn',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                    'data-toggle' => "tooltip",
                    'data-container' => 'body',
                    'data-original-title' => 'Delete'
                ]
            ),
        'buttons2' => '{save}'
    ]);
    ?>
</div>

</div>
