<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjian */

$this->title = GeneralLabel::createTitle . ' Soal Selidik Sebelum Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Soal Selidik Sebelum Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
