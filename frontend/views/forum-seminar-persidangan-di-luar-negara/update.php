<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPersidanganDiLuarNegara */

//$this->title = 'Update Forum Seminar Persidangan Di Luar Negara: ' . ' ' . $model->forum_seminar_persidangan_di_luar_negara_id;
$this->title = GeneralLabel::updateTitle . ' Bantuan Menghadiri Program Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Menghadiri Program Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Bantuan Menghadiri Program Antarabangsa', 'url' => ['view', 'id' => $model->forum_seminar_persidangan_di_luar_negara_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-persidangan-di-luar-negara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInformasiPermohonanProgramAntarabangsa' => $searchModelInformasiPermohonanProgramAntarabangsa,
        'dataProviderInformasiPermohonanProgramAntarabangsa' => $dataProviderInformasiPermohonanProgramAntarabangsa,
        'readonly' => $readonly,
    ]) ?>

</div>
