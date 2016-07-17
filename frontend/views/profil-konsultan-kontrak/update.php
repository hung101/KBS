<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilKonsultanKontrak */

$this->title = 'Update Profil Konsultan Kontrak: ' . $model->profil_konsultan_kontrak_id;
$this->params['breadcrumbs'][] = ['label' => 'Profil Konsultan Kontraks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profil_konsultan_kontrak_id, 'url' => ['view', 'id' => $model->profil_konsultan_kontrak_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profil-konsultan-kontrak-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
