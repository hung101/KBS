<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPusatLatihan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::profil_pusat_latihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_pusat_latihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
        'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
        'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
        'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
        'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
        'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
        'readonly' => $readonly,
    ]) ?>

</div>
