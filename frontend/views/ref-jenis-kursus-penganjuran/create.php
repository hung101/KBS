<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKursusPenganjuran */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kursus Penganjuran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kursus Penganjurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kursus-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
