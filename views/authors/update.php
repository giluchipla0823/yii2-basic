<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = 'Update Author: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['detail', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authors-update">

    <?= $this->render('includes/_form', [
        'model' => $model,
        'mode' => DetailView::MODE_EDIT,
        'title' => $this->title
    ]) ?>

</div>
