<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\SignupEKemudahanForm;

// table reference
use app\models\RefKategoriHakmilik;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'e-Kemudahan';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="list-group">
        <?php 
        
        $ref = RefKategoriHakmilik::findOne(['id' => \Yii::$app->user->identity->kategory_hakmilik_e_kemudahan]);
        
        /*if(\Yii::$app->user->identity->jenis_pengguna_e_kemudahan == SignupEKemudahanForm::PEMILIK){
            /*echo '<a href="' . Url::to(['/pengurusan-kemudahan-venue-msn/index']). '" class="list-group-item">Pengurusan Iklan</a>';
            if($ref['tempahan_display_flag']){
                echo '<a href="' . Url::to(['/tempahan-kemudahan-msn/index']). '" class="list-group-item">Pengurusan Tempahan</a>';
            }*/
            //$this->redirect(['pengurusan-kemudahan-venue/index']);
            /*return Yii::$app->response->redirect(Url::to(['pengurusan-kemudahan-venue/index']));
        }elseif(\Yii::$app->user->identity->jenis_pengguna_e_kemudahan == SignupEKemudahanForm::PENGGUNA){*/
            //echo '<a href="' . Url::to(["/tempahan-kemudahan-msn/create"]). '" class="list-group-item">Tempahan</a>';
            //echo '<a href="' . Url::to(['/tempahan-kemudahan-msn/index']). '" class="list-group-item">Sejarah Tempahan</a>';
            //$this->redirect(['tempahan-kemudahan/create']);
            return Yii::$app->response->redirect(Url::to(['tempahan-kemudahan-msn/create']));
        //}
        ?>
    </div>

</div>
