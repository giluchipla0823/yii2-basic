<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['/books']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-detail">
    <?=
    $this->render('includes/_form', [
        'model' => $model,
        'mode' => DetailView::MODE_VIEW,
        'title' => 'Detail: ' . $this->title
    ]);
    ?>
</div>
