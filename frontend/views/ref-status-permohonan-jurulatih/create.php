<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
