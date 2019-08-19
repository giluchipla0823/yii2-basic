<?php

namespace app\controllers;

use app\models\Ubigeo;
use yii\web\Response;
use Yii;

class UbigeoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Ubigeo;

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionSelect2()
    {
        $model = new Ubigeo;

        return $this->render('select2', [
            'model' => $model
        ]);
    }

    public function actionGetProvinces(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $params = Yii::$app->request->bodyParams['depdrop_all_params'];
        $departmentId = isset($params['department-id']) ? $params['department-id'] : NULL;

        if (!$departmentId) {
            return ['output' => '', 'selected' => ''];
        }

        $provinces = Ubigeo::find()
                ->andWhere(['department_id' => $departmentId])
                ->andWhere(['<>', 'province_id', 0])
                ->andWhere(['district_id' => 0])
                ->asArray()->all();

        $provinces = array_map(function($item){
            return [
              'id' => $item['province_id'],
              'name' => $item['description']
            ];
        }, $provinces);

        return ['output' => $provinces, 'selected' => ''];
    }

    public function actionGetDistricts(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $params = Yii::$app->request->bodyParams['depdrop_all_params'];
        $departmentId = isset($params['department-id']) ? $params['department-id'] : NULL;
        $provinceId = isset($params['province-id']) ? $params['province-id'] : NULL;

        if (!$departmentId || !$provinceId) {
            return ['output' => '', 'selected' => ''];
        }

        $districts = Ubigeo::find()
            ->andWhere(['department_id' => $departmentId])
            ->andWhere(['province_id' => $provinceId])
            ->andWhere(['<>', 'district_id', 0])
            ->asArray()->all();

        $districts = array_map(function($item){
            return [
                'id' => $item['district_id'],
                'name' => $item['description']
            ];
        }, $districts);

        return ['output' => $districts, 'selected' => ''];
    }

}
