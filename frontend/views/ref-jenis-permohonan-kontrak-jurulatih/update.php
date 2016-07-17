<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanKontrakJurulatih */

$this->title = 'Update Ref Jenis Permohonan Kontrak Jurulatih: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Permohonan Kontrak Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-permohonan-kontrak-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
