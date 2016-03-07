<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'e-Bantuan';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="list-group">
        <?php 
        echo '<a href="' . Url::to(["/permohonan-e-bantuan/create"]). '" class="list-group-item">Permohonan</a>';
        echo '<a href="' . Url::to(['/permohonan-e-bantuan/index']). '" class="list-group-item">Permohonan Terdahulu</a>';
        ?>
    </div>

</div>
