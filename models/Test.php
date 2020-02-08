<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $email
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image', 'email'], 'required'],
            [['name', 'image', 'email'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg,mp4', 'maxFiles' =>1 ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'email' => 'Email',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            echo $this->image->baseName;
            echo $this->image->extension;
            die;
            $this->image->saveAs('uploads/images/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}
