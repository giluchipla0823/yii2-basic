<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property int $author_id
 * @property int $publisher_id
 * @property string $title
 * @property string $description
 * @property int $quantity
 * @property string $price
 * @property string $image
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Author $author
 * @property Publisher $publisher
 * @property BooksGenres[] $booksGenres
 */
class Book extends \yii\db\ActiveRecord
{
    public $authorName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'publisher_id', 'quantity', 'active'], 'integer'],
            [['title', 'description', 'quantity', 'price'], 'required'],
            [['price'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['description', 'image'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['publisher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publisher::className(), 'targetAttribute' => ['publisher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'publisher_id' => 'Publisher ID',
            'title' => 'Title',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'image' => 'Image',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksGenres()
    {
        // return $this->hasMany(BooksGenres::className(), ['book_id' => 'id']);
    }
}
