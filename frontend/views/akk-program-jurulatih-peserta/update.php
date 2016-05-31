<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatihPeserta */

$this->title = 'Update Akk Program Jurulatih Peserta: ' . $model->akk_program_jurulatih_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Akk Program Jurulatih Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akk_program_jurulatih_peserta_id, 'url' => ['view', 'id' => $model->akk_program_jurulatih_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akk-program-jurulatih-peserta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
