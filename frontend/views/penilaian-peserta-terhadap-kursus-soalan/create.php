<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursusSoalan */

$this->title = 'Create Penilaian Penganjur Kursus Soalan';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Penganjur Kursus Soalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-peserta-terhadap-kursus-soalan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
