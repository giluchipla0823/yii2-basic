<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $author app\models\Author */

$this->title = 'Create Book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['/books']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-create">

    <?= $this->render('includes/_form', [
        'model' => $model,
        'author' => $author,
        'mode' => DetailView::MODE_EDIT,
        'title' => $this->title
    ]) ?>

</div>
