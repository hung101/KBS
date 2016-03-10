<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanKontrakJurulatih */

$this->title = 'Update Ref Status Permohonan Kontrak Jurulatih: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Kontrak Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-permohonan-kontrak-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
