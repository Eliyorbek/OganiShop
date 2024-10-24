<?php

namespace backend\controllers;

use common\models\Product;
use common\models\search\ProductSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Pimage;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->scenario = 'create';
        if ($this->request->isPost) {
         if ($model->load($this->request->post())) {
             $path = \Yii::getAlias('@frontend/web/uploads/product_img/');
            if($model->save()){
                $imgFiles = UploadedFile::getInstances($model, 'image');
                foreach($imgFiles as $file) {
                    $img = md5(rand(111,999).microtime()).'.'.$file->extension;
                    if(!is_dir($path)){
                        mkdir($path,0777,true);
                    }
                    $file->saveAs($path.$img);
                    $model->image = $img;
                    $imgModel = new Pimage([
                        'product_id' => $model->id,
                        'path' => $model->image,
                    ]);
                    $imgModel->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $model->loadDefaultValues();
            }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($this->request->isPost) {

            if(UploadedFile::getInstances($model, 'image')){
                $path = \Yii::getAlias('@frontend/web/uploads/product_img/');
                $imgFiles = UploadedFile::getInstances($model, 'image');
                if($model->save()){
                    foreach($imgFiles as $file){
                        $img = md5(rand(111,999).microtime()).'.'.$file->extension;
                        if(file_exists($path.$img)){
                            unlink($path.$img);
                        }
                        $file->saveAs($path.$img);
                        $model->image = $img;

                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model = $this->findModel($id);
        if($model->pimages != null){
            foreach($model->pimages as $pimage){
                if(\Yii::getAlias('@frontend/web/uploads/product_img/'.$pimage->path)){
                    unlink(\Yii::getAlias('@frontend/web/uploads/product_img/'.$pimage->path));
                }
                $pimage->delete();
            }
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
