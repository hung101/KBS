<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanGeranBantuanGajiJurulatih */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kelulusan_geran_bantuan_gaji_jurulatih.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_geran_bantuan_gaji_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-kelulusan-geran-bantuan-gaji-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
