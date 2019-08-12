<?php

use yii\helpers\Html;
use app\libraries\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="countries-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'grid-countries', 'timeout' => false, 'enablePushState' => false]) ?>

    <?= GridView::widget([
        'id' => 'grid-countries',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-book"></i>  Listado de Países',
            'options' => [
                'class' => 'kv-panel'
            ]
        ],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'toolbar' =>  [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i> New', ['create'], ['title' => 'Nuevo', 'class'=>'btn btn-success']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Resetear grid'])
            ]
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'label' => 'ID',
                'width' => '8%',
                'visible' => FALSE,
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
            ],
            [
                'attribute' => 'code',
                'label' => 'Código',
                'width' => '10%',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
                'vAlign' => 'middle'
            ],
            [
                'attribute' => 'name',
                'label' => 'Nombre',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
                'vAlign' => 'middle'
            ],
            [
                'attribute' => 'population',
                'label' => 'Población',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
                'vAlign' => 'middle',
                'width' => '15%',
            ],
            [
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'class' => \kartik\grid\ActionColumn::class,
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{view} {update}',
                'width' => '12%',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            [
                                'detail',
                                'id' => $model->id
                            ],
                            [
                                'title' => Yii::t('app', 'lead-view'),
                                'class' => 'btn btn-default btn-sm'
                            ]
                        );
                    },

                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            [
                                'update',
                                'id' => $model->id
                            ],
                            [
                                'title' => Yii::t('app', 'lead-update'),
                                'class' => 'btn btn-primary btn-sm'
                            ]
                        );
                    },
                ]
            ]
        ]
    ]); ?>

    <?php Pjax::end(); ?>


</div>
