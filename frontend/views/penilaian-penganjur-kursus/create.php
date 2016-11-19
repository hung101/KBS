<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View delete()*/
/* @var $model app\models\PenilaianPenganjurKursus */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penilaian_penganjur_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_penganjur_kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-penganjur-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPenganjurKursusSoalan' => $searchModelPenilaianPenganjurKursusSoalan,
        'dataProviderPenilaianPenganjurKursusSoalan' => $dataProviderPenilaianPenganjurKursusSoalan,
        'readonly' => $readonly,
    ]) ?>

</div>
