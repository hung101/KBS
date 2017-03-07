<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifPersatuan */

$this->title = 'Create Pembayaran Insentif Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-persatuan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
