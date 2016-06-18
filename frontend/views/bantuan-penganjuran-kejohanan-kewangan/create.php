<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananKewangan */

$this->title = 'Create Bantuan Penganjuran Kejohanan Kewangan';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Kewangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-kewangan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>


</div>
