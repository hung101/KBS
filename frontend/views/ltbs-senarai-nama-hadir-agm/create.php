<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirAgm */

$this->title = GeneralLabel::tambah_nama_kehadiran_mesyuarat_agong;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_nama_kehadiran_mesyuarat_agong, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-senarai-nama-hadir-agm-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
