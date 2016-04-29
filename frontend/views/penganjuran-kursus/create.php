<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursus */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penganjuran_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['akademi-akk/index']];
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cce, 'url' => ['kursus/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
