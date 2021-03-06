<?php
// Edward add quick fix for live server using HTTPS for iframe mix content issue  - START

$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    // not valid
    $_SERVER['HTTPS']='on';
}
// Edward add quick fix for live server using HTTPS for iframe mix content issue  - END

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);
// eddie start
$session = Yii::$app->getSession();

// set default language session
    if($session->get('language') == null || $session->get('language') == "") {
	$session->set('language', "BM");
}

if($session->get(Yii::$app->user->authTimeoutParam)) {

	if($session->get(Yii::$app->user->authTimeoutParam) > time()) {
		// reset timeout
		$session->set(Yii::$app->user->authTimeoutParam, time() + Yii::$app->params['expiryTimeout']);
	} else {
		// expired
		Yii::$app->user->logout();
	}
	
}
// eddie end
$application->run();

