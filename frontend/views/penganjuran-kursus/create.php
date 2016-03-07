<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursus */

$this->title = GeneralLabel::createTitle . ' Penganjuran Kursus';
$this->params['breadcrumbs'][] = ['label' => 'Akademi Kejurulatihan Kebangsaan (AKK)', 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => 'CCE', 'url' => ['kursus/index']];
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
