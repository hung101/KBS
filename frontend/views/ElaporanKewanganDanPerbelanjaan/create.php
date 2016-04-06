<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKewanganDanPerbelanjaan */

$this->title = GeneralLabel::tambah_elaporan_kewangan_dan_perbelanjaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_kewangan_dan_perbelanjaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-kewangan-dan-perbelanjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
