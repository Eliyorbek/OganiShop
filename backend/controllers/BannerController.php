<?php

namespace backend\controllers;

use common\models\Banner;
use common\models\search\BannerSearch;
use common\models\search\BrendSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete' ,'index','view'],
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Banner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Banner();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $imgName = UploadedFile::getInstance($model , 'image');
                $img = md5(rand(1111,9999) . microtime()).'.'.$imgName->extension;
                $model->image = $img;
                $path = \Yii::getAlias('@frontend/web/uploads/banner_img/');
                if(!is_dir($path)){
                    mkdir($path,0777,true);
                }
                $imgName->saveAs($path.$img);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id , 'path'=>$path]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($this->request->isPost && $model->load($this->request->post())) {
            if(UploadedFile::getInstance($model , 'image')!= null){
                $imgName = UploadedFile::getInstance($model , 'image');
                $img = md5(rand(1111,9999) . microtime()).'.'.$imgName->extension;
                $path = \Yii::getAlias('@frontend/web/uploads/banner_img/');
                if(file_exists(\Yii::getAlias('@frontend/web/uploads/banner_img/'.$model->image))){
                    unlink(\Yii::getAlias('@frontend/web/uploads/banner_img/'.$model->image));
                }
                $model->image = $img;
                $imgName->saveAs($path.$img);
            }else{
                $img = $model->image;
            }
            $model->image = $img;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model =  $this->findModel($id);
       if(file_exists(\Yii::getAlias('@frontend/web/uploads/banner_img/'.$model->image))){
           unlink(\Yii::getAlias('@frontend/web/uploads/banner_img/'.$model->image));
       }
       $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
