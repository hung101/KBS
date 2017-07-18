<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananElemen */

$this->title = 'Create Bantuan Penganjuran Kejohanan Elemen';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Elemens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-elemen-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
