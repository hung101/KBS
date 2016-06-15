<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPusatLatihanJurulatih */

$this->title = 'Update Profil Pusat Latihan Jurulatih: ' . $model->profil_pusat_latihan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Profil Pusat Latihan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profil_pusat_latihan_jurulatih_id, 'url' => ['view', 'id' => $model->profil_pusat_latihan_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profil-pusat-latihan-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
