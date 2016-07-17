<?php

use yii\helpers\Html;


use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih */

$this->title = 'Tempoh Kontrak';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelanjutan_dan_penamatan_kontrak_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
