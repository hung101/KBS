<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanGeranBantuanGajiJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan_geran_bantuan_gaji_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan_geran_bantuan_gaji_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-geran-bantuan-gaji-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
