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

    public function actionIndex($param1=null)
    {

//        $this->actionGetexample();die;
        $request = Yii::$app->request;

        if ( isset(Yii::$app->params["remoteApiServer"]) ){
            $serverApi = Yii::$app->params["remoteApiServer"];
            $list = Yii::$app->params["listOfAlltMarkers"];
        }
        else
            return false;

        $json = file_get_contents($serverApi.'/'.$list);

        $json_array = json_decode($json, true);

        if($request->get('filter')){
            foreach($json_array as $k => $obj){
                //if (($key = array_search($request->get('filter'), $obj)) !== false) unset($json_array[$k]);
                if($obj['type'] !== $request->get('filter')){
                    unset($json_array[$k]);
                }
            }
        }

        return $this->render('getmap', array('markers'=>$json_array));
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

            if(!empty($response)){
                Yii::$app->session->setFlash('addpointFormSubmitted');
            }else{
                Yii::$app->session->setFlash('addpointFormError');
            }

            //return $this->redirect('/site/getmap');
        }

        return $this->render('addpoint', [
            'model' => $model,
        ]);
    }

    public function actionGetmap()
    {
//echo $param1; die;

        return $this->actionIndex();

    }
    public function actionGetapi()
    {
        return $this->render('getapi');

    }

    public function actionMobile()
    {
        return $this->render('mobile');
    }



}
