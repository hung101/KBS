<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPusatLatihan */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::profil_pusat_latihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_pusat_latihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_pusat_latihan, 'url' => ['view', 'id' => $model->profil_pusat_latihan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
        'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
        'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
        'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
        'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
        'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
        'searchModelProfilPusatLatihanSukan' => $searchModelProfilPusatLatihanSukan,
        'dataProviderProfilPusatLatihanSukan' => $dataProviderProfilPusatLatihanSukan,
        'searchModelProfilPusatLatihanProgram' => $searchModelProfilPusatLatihanProgram,
        'dataProviderProfilPusatLatihanProgram' => $dataProviderProfilPusatLatihanProgram,
        'readonly' => $readonly,
    ]) ?>

</div>
