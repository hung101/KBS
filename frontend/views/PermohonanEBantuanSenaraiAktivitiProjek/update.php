<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiAktivitiProjek */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_senarai_aktiviti_projek.': ' . ' ' . $model->senarai_aktiviti_projek_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_senarai_aktiviti_projeks, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_aktiviti_projek_id, 'url' => ['view', 'id' => $model->senarai_aktiviti_projek_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-senarai-aktiviti-projek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
