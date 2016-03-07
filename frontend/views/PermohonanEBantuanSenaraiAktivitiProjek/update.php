<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiAktivitiProjek */

$this->title = 'Update Permohonan Ebantuan Senarai Aktiviti Projek: ' . ' ' . $model->senarai_aktiviti_projek_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Senarai Aktiviti Projeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_aktiviti_projek_id, 'url' => ['view', 'id' => $model->senarai_aktiviti_projek_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-senarai-aktiviti-projek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
