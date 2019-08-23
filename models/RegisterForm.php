<?php


namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['name', 'username', 'email', 'password', 'password_repeat'], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 191],
            // [['username', 'auth_key'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 50],
            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['username', 'username_exists'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email'],
            ['email', 'email_exists'],
            ['password', 'match', 'pattern' => "/^.{6,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    public function email_exists($attribute, $params)
    {

        //Buscar el email en la tabla
        $table = User::find()->where("email = :email", [":email" => $this->email]);

        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El email seleccionado existe");
        }
    }

    public function username_exists($attribute, $params)
    {
        // Buscar el username en la tabla
        $table = User::find()->where("username = :username", [":username" => $this->username]);

        // Si el username existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El usuario seleccionado existe");
        }
    }

}