<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Register</h1>
<hr />

<?php $form = ActiveForm::begin([
    'method' => 'post',
    'id' => 'formulario',
    'enableAjaxValidation' => true,
]);
?>
    <div class="form-group">
        <?= $form->field($model, "name")->input("text")->label('Nombres'); ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, "username")->input("text")->label('Usuario'); ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, "email")->input("email")->label('Email'); ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, "password")->input("password")->label('Contraseña'); ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, "password_repeat")->input("password")->label('Repetir contraseña'); ?>
    </div>

    <?= Html::submitButton("Guardar datos", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>