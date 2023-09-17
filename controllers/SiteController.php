<?php

namespace app\controllers;

use app\models\Composition;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Road;
use app\models\Route;
use app\models\Station;
use app\models\Transport;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        if ((Yii::$app->session)['enter'] == 3) {
            (Yii::$app->session)->destroy();
            return $this->goHome();
        }
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

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->userRegister()) {
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('register', [
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

    public function actionFormOptimalRoute()
    {
        $model = new Road();

        if (Yii::$app->request->isPost) {
            $start = Yii::$app->request->post()['Road']['start_station_id'];
            $end = Yii::$app->request->post()['Road']['final_station_id'];
            $query = Route::getOptimalRoute($start, $end);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
                'pagination' => false,
            ]);
            return $this->render('view-optimal-route', ['dataProvider' => $dataProvider]);
        }

        $listStart = ArrayHelper::map(Station::find()->orderBy('title')->all(), 'id', 'title');
        $listEnd = ArrayHelper::map(Station::find()->orderBy('title')->all(), 'id', 'title');
        return $this->render('form-optimal-route', ['model' => $model, 'listStart' => $listStart, 'listEnd' => $listEnd]);
    }

    public function actionFormWaitingTrolleybus()
    {
        $model = new Route();

        if (Yii::$app->request->isPost) {
            $number = Yii::$app->request->post()['Route']['route_number'];
            $query = Route::getWaitingTrolleybus($number);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
                'pagination' => false,
            ]);
            return $this->render('view-waiting-trolleybus', ['dataProvider' => $dataProvider]);
        }

        $listNumber = ArrayHelper::map(Route::find()->innerJoin('transport', 'transport.id = route.transport_id')->where(['transport.type' => 'Троллейбус'])->orderBy('route_number')->all(), 'route_number', 'route_number');
        return $this->render('form-waiting-trolleybus', ['model' => $model, 'listNumber' => $listNumber]);
    }

    public function actionTramRoutes()
    {
        $query = Route::getTramRoutes();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('tram-routes', ['dataProvider' => $dataProvider]);
    }

    public function actionProfit()
    {
        $query = Route::getProfit();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('profit', ['dataProvider' => $dataProvider]);
    }

    
}
