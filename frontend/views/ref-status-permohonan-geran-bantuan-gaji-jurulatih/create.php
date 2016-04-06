<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanGeranBantuanGajiJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Geran Bantuan Gaji Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Geran Bantuan Gaji Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-geran-bantuan-gaji-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
