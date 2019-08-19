<?php

use app\models\Ubigeo;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$departments = ArrayHelper::map(Ubigeo::find()
    ->andWhere(['<>', 'department_id', 0])
    ->andWhere(['province_id' => 0])
    ->andWhere(['district_id' => 0])
    ->asArray()->all(), 'department_id', 'description');

?>
<h1>Ubigeo</h1>
<hr />

<?php
$form = ActiveForm::begin();
?>

<?php
// Departamentos
echo $form->field($model, 'department_id')
          ->dropDownList($departments, ['id' => 'department-id', 'prompt' => 'Seleccionar']);
?>

<?php
// Provincias
echo $form->field($model, 'province_id')->widget(DepDrop::classname(), [
    'options' => ['id' => 'province-id', 'placeholder' => 'Seleccionar'],
    'pluginOptions'=>[
        'depends'=>['department-id'],
        'placeholder' => 'Seleccionar',
        'url' => Url::to(['/ubigeo/get-provinces'])
    ]
]);
?>

<?php
// Distritos
echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
    'options' => ['id' => 'district-id', 'placeholder' => 'Seleccionar'],
    'pluginOptions'=>[
        'initialize' => true,
        'initDepends'=>['department-id', 'province-id'],
        'depends'=>['department-id', 'province-id'],
        'placeholder' => 'Seleccionar',
        'url' => Url::to(['/ubigeo/get-districts'])
    ]
]);
?>

<?php ActiveForm::end() ?>

