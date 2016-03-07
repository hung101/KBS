<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanPendidikan */

$this->title = GeneralLabel::createTitle . ' Permohonan Penganjuran Program/Kursus/Bengkel';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Penganjuran Program/Kursus/Bengkel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
