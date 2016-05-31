<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuanPenasihat */

$this->title = 'Create Pengurusan Permohonan Kursus Persatuan Penasihat';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Permohonan Kursus Persatuan Penasihats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-kursus-persatuan-penasihat-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
