<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = 'Update Country: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['/country']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['detail', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="countries-update">

    <?= $this->render('includes/_form', [
        'model' => $model,
        'mode' => DetailView::MODE_EDIT,
        'title' => $this->title
    ]) ?>

</div>
