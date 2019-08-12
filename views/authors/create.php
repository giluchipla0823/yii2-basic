<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = 'Create Author';
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-create">

    <?= $this->render('includes/_form', [
        'model' => $model,
        'mode' => DetailView::MODE_EDIT,
        'title' => $this->title
    ]) ?>

</div>
