<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianJurulatih */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_penilaian_jurulatih.': ' . ' ' . $model->pengurusan_penilaian_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penilaian_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_penilaian_jurulatih_id, 'url' => ['view', 'id' => $model->pengurusan_penilaian_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-penilaian-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
