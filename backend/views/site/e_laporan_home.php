<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'e-Laporan';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="list-group">
        <?php 
        //echo '<a href="' . Url::to(["/elaporan-pelaksanaan/create", 'permohonan_e_bantuan_id' => '']). '" class="list-group-item">e-Laporan</a>';
        //echo '<a href="' . Url::to(['/elaporan-pelaksanaan/index']). '" class="list-group-item">Sejarah e-Laporan</a>';
        
        return Yii::$app->response->redirect(Url::to(['elaporan-pelaksanaan/index']));
        ?>
    </div>

</div>
