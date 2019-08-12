<?php

namespace app\libraries;

use \kartik\detail\DetailView as KartikDetailView;
use yii\helpers\Html;

class DetailView extends KartikDetailView
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->buttons1 = isset($config['buttons1']) ? $config['buttons1'] : $this->_settingButtons1();
        $this->buttons2 = isset($config['buttons2']) ? $config['buttons2'] : '{save}';
    }

    private function _settingButtons1(){
        return  Html::a(
                '<i class="glyphicon glyphicon-pencil"></i>',
                [
                    'update',
                    'id' => $this->model->id
                ],
                [
                    'class' => 'kv-action-btn',
                    'data-toggle' => "tooltip",
                    'data-container' => 'body',
                    'data-original-title' => 'Update'
                ]
            )
            . Html::a(
                '<i class="glyphicon glyphicon-trash"></i>',
                [
                    'delete',
                    'id' => $this->model->id
                ],
                [
                    'class' => 'kv-action-btn',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                    'data-toggle' => "tooltip",
                    'data-container' => 'body',
                    'data-original-title' => 'Delete'
                ]
            );
    }
}