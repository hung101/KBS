<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilDelegasiTeknikalAhli */

$this->title = 'Update Profil Delegasi Teknikal Ahli: ' . $model->profil_delegasi_teknikal_id;
$this->params['breadcrumbs'][] = ['label' => 'Profil Delegasi Teknikal Ahlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profil_delegasi_teknikal_id, 'url' => ['view', 'id' => $model->profil_delegasi_teknikal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profil-delegasi-teknikal-ahli-update">

    <!--<<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
