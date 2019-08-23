<?php

namespace app\controllers;

use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = new User();

            $user->name = $model->name;
            $user->username = $model->username;
            $user->email = $model->email;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $user->activate = 0;

            //clave será utilizada para activar el usuario
            $user->auth_key = $this->_generateSecretKey('secret');
            $user->access_token = $this->_generateSecretKey('secret_access_token');

            if($user->save()){
                $id = $user->id;
                $authKey = $user->auth_key;

                $subject = "Confirmar registro";
                $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                $body .= "<a href=". Url::toRoute('site/confirm', true) ."?id=". $id ."&authKey=". $authKey .">Confirmar</a>";

                //Enviamos el correo
                Yii::$app->mailer->compose()
                    // ->setTo($user->email)
                    ->setTo('luiggiplasencia0823@gmail.com')
                    ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();
            }

            return $this->redirect(['register']);
        }

        return $this->render("register", ["model" => $model]);
    }

    public function actionConfirm()
    {
        if (Yii::$app->request->get()) {
            $id = $_GET["id"] ?: NULL;
            $authKey = $_GET["authKey"] ?: NULL;

            if (!$id || !$authKey) {
                return $this->redirect(["site/login"]);
            }

            $user = User::findOne(['id' => $id, 'auth_key' => $authKey]);

            if(!$user){
                return $this->redirect(["site/login"]);
            }

            $user->activate = 1;
            $user->save();

            echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
            echo "<meta http-equiv='refresh' content='8; " . Url::toRoute("site/login") . "'>";
            return;
        }

        return $this->redirect(["site/login"]);
    }

    private function _generateSecretKey($value){
        $hash = Yii::$app->getSecurity()->generatePasswordHash($value);

        return substr($hash, 7);
    }
}
