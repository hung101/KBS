<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LawatanRasmiLuarNegaraPegawai */

$this->title = 'Create Lawatan Rasmi Luar Negara Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Lawatan Rasmi Luar Negara Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lawatan-rasmi-luar-negara-pegawai-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
