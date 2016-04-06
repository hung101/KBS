<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPesertaSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::penganjuran_kursus_peserta_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus_peserta_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-sukan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
