<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPeserta */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penganjuran_kursus_senarai_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus_senarai_peserta, 'url' => Url::to(['index', 'penganjuran_kursus_id' => $penganjuran_kursus_id, 'penganjuran_kursus_akk_id' => $penganjuran_kursus_akk_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenganjuranKursusPesertaSukan' => $searchModelPenganjuranKursusPesertaSukan,
        'dataProviderPenganjuranKursusPesertaSukan' => $dataProviderPenganjuranKursusPesertaSukan,
        'readonly' => $readonly,
    ]) ?>

</div>
