<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifAtlet */

$this->title = 'Create Pembayaran Insentif Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-atlet-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
