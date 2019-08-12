<?php

use yii\helpers\Html;
use app\libraries\GridView;
use yii\widgets\Pjax;
use \kartik\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'grid-authors', 'timeout' => false, 'enablePushState' => false]) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id' => 'grid-authors',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-book"></i>  Listado de Autores',
            'options' => [
                'class' => 'kv-panel'
            ]
        ],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'toolbar' =>  [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i> New ', ['create'], ['title' => 'Nuevo', 'class'=>'btn btn-success']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i> ', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Resetear grid'])
            ]
        ],
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Nombre',
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
                'vAlign' => 'middle'
            ],
            [
                'attribute' => 'active',
                'label' => 'Estado',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'kartik-sheet-style text-center'],
                'filter' => ["1" => "Habilitado", "2" => "Deshabilitado"],
                'vAlign' => 'middle',
                'width' => '12%',
                'value' => function($model){

                    if($model->active === 1){
                        return Html::tag('span', 'Habilitado', ['class' => 'label label-success']);
                    }

                    return Html::tag('span', 'Deshabilitado', ['class' => 'label label-danger']);
                },
                'format' => 'raw'
            ],
            [
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'class' => ActionColumn::class,
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
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
