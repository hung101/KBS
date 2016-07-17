<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSukanAcara */

$this->title = 'Update Jurulatih Sukan Acara: ' . $model->jurulatih_sukan_acara_id;
$this->params['breadcrumbs'][] = ['label' => 'Jurulatih Sukan Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jurulatih_sukan_acara_id, 'url' => ['view', 'id' => $model->jurulatih_sukan_acara_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurulatih-sukan-acara-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
