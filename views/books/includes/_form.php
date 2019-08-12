<?php
use yii\helpers\Html;
use app\libraries\DetailView;
use kartik\widgets\Select2;
use app\models\Author;
use app\models\Publisher;
use yii\helpers\ArrayHelper;
?>

<div class="books-form">
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
                'label' => 'Título',
                'attribute' => 'title',
            ],
            [
                'label' => 'Descripción',
                'attribute' => 'description',
                'type' => DetailView::INPUT_TEXTAREA
            ],
            [
                'columns' => [
                    [
                        'label' => 'Autor',
                        'attribute' => 'author_id',
                        'value' => $model->author ? $model->author->name : NULL,
                        'type' => DetailView::INPUT_SELECT2,
                        'widgetOptions' => [
                            'data' => ArrayHelper::map(Author::find()->asArray()->all(), 'id', 'name'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'pluginOptions' => [
                                'allow-clear' => TRUE,
                                'placeholder' => 'Seleccionar'
                            ]
                        ],
                        'valueColOptions' => ['style' => 'width:30%']
                    ],
                    [
                        'label' => 'Publicador',
                        'attribute' => 'publisher_id',
                        'value' => $model->publisher ? $model->publisher->name : NULL,
                        'type' => DetailView::INPUT_SELECT2,
                        'widgetOptions' => [
                            'data' => ArrayHelper::map(Publisher::find()->asArray()->all(), 'id', 'name'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'pluginOptions' => [
                                'allow-clear' => TRUE,
                                'placeholder' => 'Seleccionar'
                            ]
                        ],
                        'valueColOptions' => ['style' => 'width:30%']
                    ]
                ]
            ],
            [
                'columns' => [
                    [
                        'label' => 'Cantidad',
                        'attribute' => 'quantity',
                        'valueColOptions' => ['style' => 'width:30%']
                    ],
                    [
                        'label' => 'Precio',
                        'attribute' => 'price',
                        'type' => DetailView::INPUT_TEXT,
                        'valueColOptions' => ['style' => 'width:30%']
                    ]
                ]
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
