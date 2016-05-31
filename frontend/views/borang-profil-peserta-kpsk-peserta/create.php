<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpskPeserta */

$this->title = 'Create Borang Profil Peserta Kpsk Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Borang Profil Peserta Kpsk Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
