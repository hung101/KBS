<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfilKonsultanKontrak */

$this->title = 'Create Profil Konsultan Kontrak';
$this->params['breadcrumbs'][] = ['label' => 'Profil Konsultan Kontraks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-konsultan-kontrak-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
