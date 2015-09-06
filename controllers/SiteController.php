<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AddpointForm;

use linslin\yii2\curl;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Test
     */
    public function actionGetexample()
    {
        //Init curl
        $curl = new curl\Curl();

        //get http://example.com/
        $response = $curl->get('http://146.185.190.210:3000/locations');

        echo $response;
    }

    /**
     * Add new point
     */
    public function actionAdd()
    {
        $postUrl = Yii::$app->params['remoteApiServer'] . '/locations';

        //Init curl
        $curl = new curl\Curl();

        $model = new AddpointForm();
        if ($model->load(Yii::$app->request->post())) {

            $pointData = $model->validateData();

            //post
           $response = $curl->setOption(
                CURLOPT_POSTFIELDS,
                http_build_query($pointData)
            )
           ->post($postUrl);

            // Yii::$app->session->setFlash('addpointFormSubmitted');
            return $this->refresh();
        }

        return $this->render('addpoint', [
            'model' => $model,
        ]);
    }

    public function actionGetmap()
    {
        if ( isset(Yii::$app->params["remoteApiServer"]) ){
            $serverApi = Yii::$app->params["remoteApiServer"];
            $list = Yii::$app->params["listOfAlltMarkers"];
        }
        else
            return false;

        $json = file_get_contents($serverApi.'/'.$list);

        $json_array = json_decode($json, false);

        return $this->render('getmap', array('markers'=>$json_array));

    }

}
