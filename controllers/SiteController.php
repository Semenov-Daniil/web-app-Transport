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
            (Yii::$app->session)['array'] = $query;
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
            (Yii::$app->session)['array'] = $query;
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
        (Yii::$app->session)['array'] = $query;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('tram-routes', ['dataProvider' => $dataProvider]);
    }

    public function actionProfit()
    {
        $query = Route::getProfit();
        (Yii::$app->session)['array'] = $query;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => false,
        ]);
        return $this->render('profit', ['dataProvider' => $dataProvider]);
    }

    public function actionExport1()
    {
        $list = (Yii::$app->session)['array'];
        $fileName = Yii::$app->request->get('title') . '.csv';
        
        $fp = fopen(Yii::getAlias('@app') . '\export_file\\' . $fileName, 'w+');

        if ($list) {
            fputcsv($fp, $this->lable(array_keys($list[0])), ';');
            foreach ($list as $fields) {
                fputcsv($fp, $fields, ';');
            }
        }


        fclose($fp);

        $filePath = Yii::getAlias('@app') . '\export_file\\' . $fileName;

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/csv');
        $response->headers->add('Content-Disposition', "attachment; filename=$fileName");

        $response->sendFile($filePath)->send();
    }

    public function actionExport2()
    {
        $list = (Yii::$app->session)['array'];
        $fileName = Yii::$app->request->get('title') . '.csv';
        $text = '';

        if ($list) {
            $text = implode(';', $this->lable(array_keys($list[0]))) . PHP_EOL;
            
            foreach ($list as $fields) {
                $text .= implode(';', $fields) . PHP_EOL;
            }
        }

        $response = Yii::$app->response;

        $response->headers->add('Content-Type', 'text/csv');
        $response->headers->add('Content-Disposition', "attachment; filename=$fileName");

        $response->sendContentAsFile(iconv('UTF-8', 'Windows-1251', $text), $fileName)->send();
    }

    public function lable($array)
    {
        $lable = [
            'route_number' => 'Номер маршрута',
            'time_in_stops' => 'Время ожидание на остановке',
            'alltime' => 'Время маршрута',
            'stops' => 'Количество остановок',
            'start' => 'Начальный пункт',
            'end' => 'Конечный пункт',
            'time' => 'Время',
            'distance' => 'Дистанция',
            'profit' => 'Прибыль',
            'type' => 'Транспорт',
        ];

        foreach ($array as $key => $val) {
            foreach ($lable as $key2 => $val2) {
                if ($val == $key2) {
                    $array[$key] = $val2;
                    continue;
                }
            }
        }

        return $array;
    }
}
