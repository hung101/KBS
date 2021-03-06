<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilKonsultan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::profil_kaunselor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_kaunselor, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-konsultan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilKonsultanKontrak' => $searchModelProfilKonsultanKontrak,
        'dataProviderProfilKonsultanKontrak' => $dataProviderProfilKonsultanKontrak,
        'readonly' => $readonly,
    ]) ?>

</div>
