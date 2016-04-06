<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PemberianSuplemenMakananJusRundinganPendidikan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pemberian_suplemen_makanan_jus_rundingan_pendidikan.': ' . ' ' . $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemberian_suplemen_makanan_jus_rundingan_pendidikans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id, 'url' => ['view', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemberian-suplemen-makanan-jus-rundingan-pendidikan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
