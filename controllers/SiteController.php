<?php

namespace app\controllers;

use app\models\Photo;
use app\models\PhotoSearch;
use app\widgets\Alert;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class SiteController
 *
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        $model = new Photo();
        $searchModel = new PhotoSearch();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            try {
                if ($model->save()) {
                    $model->saveUploadedFile();
                    Alert::success('Photo was successfully uploaded');
                } else {
                    Alert::danger('Photo was not uploaded due to the unknown reason');
                }
            } catch (\RuntimeException $exception) {
                Alert::danger($exception->getMessage());
            }

            return $this->redirect(Yii::$app->homeUrl);
        }

        return $this->render('index', [
            'dataProvider' => $searchModel->search(),
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDeletePhoto(int $id): Response
    {
        $photo = Photo::findOne($id);
        if (null === $photo) {
            throw new NotFoundHttpException('Photo does not exist');
        }
        if ($photo->delete()) {
            Alert::success('Photo was deleted');
        } else {
            Alert::danger('Photo was not deleted due to the unknown reason');
        }

        return $this->redirect(Yii::$app->homeUrl);
    }
}
