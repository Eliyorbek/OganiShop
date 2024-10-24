<?php

namespace backend\controllers;

use common\models\Category;
use common\models\search\CategorySearch;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->scenario = 'create';
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->name = $this->request->post('Category')['name'];
                $imgName = UploadedFile::getInstance($model, 'image');
                $img = md5(rand(1111, 9999) . microtime()) . '.' . $imgName->extension;
                $model->image = $img;
                if (isset($this->request->post()['status'])) {
                    $model->status = 'active';
                } else {
                    $model->status = 'inactive';
                }
                $path = \Yii::getAlias('@frontend/web/uploads/cat_img/');
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $imgName->saveAs($path . $img);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
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
            if (UploadedFile::getinstance($model, 'image') != null) {
                $imgName = UploadedFile::getInstance($model, 'image');
                $img = md5(rand(1111, 9999) . microtime()) . '.' . $imgName->extension;
                if (file_exists(\Yii::getAlias('@frontend/web/uploads/cat_img/' . $model->image))) {
                    unlink(\Yii::getAlias('@frontend/web/uploads/cat_img/' . $model->image));
                }
                $imgName->saveAs(\Yii::getAlias('@frontend/web/uploads/cat_img/' . $img));
            } else {
                $img = $model->image;
            }

            if ($model->load(Yii::$app->request->post())) {
                if (isset($this->request->post()['status'])) {
                    $model->status = 'active';
                } else {
                    $model->status = 'inactive';
                }
                $model->image = $img;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $path = \Yii::getAlias('@frontend/web/uploads/cat_img/');
        if (file_exists($path . $model->image)) {
            unlink($path . $model->image);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionChangeStatus($id)
    {

        $model = $this->findModel($id);

        $model->status == 'active' ? $model->status = 'inactive' : $model->status = 'active';

        $model->save();

        return $this->redirect(Yii::$app->request->referrer);
    }
}
