<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKursusPenganjuran */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kursus_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kursus_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kursus-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
