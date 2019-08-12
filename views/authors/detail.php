<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="authors-detail">
    <?=
        $this->render('includes/_form', [
           'model' => $model,
           'mode' => DetailView::MODE_VIEW,
           'title' => 'Detail: ' . $this->title
        ]);
    ?>
</div>
