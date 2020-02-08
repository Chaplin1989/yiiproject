<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Test;
use yii\web\UploadedFile;


class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('test');
    }

    public function actionForm()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new Test();
        if ($model->load(Yii::$app->request->post())){
           
            $data = Yii::$app->request->post();
            if($data['_csrf']){
               unset($data['_csrf']);
           }
           $model->image = UploadedFile::getInstances($model, 'image');
           $model->upload();
                
        //     echo "<pre>";
        //     print_r($model['image']);
        //    //echo($model->image->baseName);
        //     die;
            foreach ($model->image as $im){
                $uniqueName = uniqid().$im->name;
            }
            echo $uniqueName;
                die;
        } else {
            return $this->render('form',['model' => $model]);
        }
    }
}
