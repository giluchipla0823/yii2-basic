<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['/country']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="countries-detail">
    <?=
        $this->render('includes/_form', [
           'model' => $model,
           'mode' => DetailView::MODE_VIEW,
           'title' => 'Detail: ' . $this->title
        ]);
    ?>
</div>
