<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilDelegasiTeknikal */

$this->title = GeneralLabel::profil_delegasi_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_delegasi_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="profil-delegasi-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilDelegasiTeknikalAhli' => $searchModelProfilDelegasiTeknikalAhli,
        'dataProviderProfilDelegasiTeknikalAhli' => $dataProviderProfilDelegasiTeknikalAhli,
        'readonly' => $readonly,
    ]) ?>

</div>
