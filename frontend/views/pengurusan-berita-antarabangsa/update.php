<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBeritaAntarabangsa */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::maklumat_antarabangsa.': ' . ' ' . $model->pengurusan_berita_antarabangsa_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::maklumat_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_antarabangsa, 'url' => ['view', 'id' => $model->pengurusan_berita_antarabangsa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-berita-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanBeritaAntarabangsaMuatnaik' => $searchModelPengurusanBeritaAntarabangsaMuatnaik,
        'dataProviderPengurusanBeritaAntarabangsaMuatnaik' => $dataProviderPengurusanBeritaAntarabangsaMuatnaik,
        'readonly' => $readonly,
    ]) ?>

</div>
