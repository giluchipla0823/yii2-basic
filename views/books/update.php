<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = 'Update Book: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['/books']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['detail', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="books-update">

    <?= $this->render('includes/_form', [
        'model' => $model,
        'mode' => DetailView::MODE_EDIT,
        'title' => $this->title
    ]) ?>

</div>
