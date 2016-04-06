<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanKontrakJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Kontrak Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Kontrak Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-kontrak-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
