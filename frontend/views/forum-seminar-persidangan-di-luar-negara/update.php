<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPersidanganDiLuarNegara */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::forum_seminar_persidangan_di_luar_negara.': ' . ' ' . $model->forum_seminar_persidangan_di_luar_negara_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bantuan_menghadiri_program_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_menghadiri_program_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_menghadiri_program_antarabangsa, 'url' => ['view', 'id' => $model->forum_seminar_persidangan_di_luar_negara_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-persidangan-di-luar-negara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInformasiPermohonanProgramAntarabangsa' => $searchModelInformasiPermohonanProgramAntarabangsa,
        'dataProviderInformasiPermohonanProgramAntarabangsa' => $dataProviderInformasiPermohonanProgramAntarabangsa,
		'searchModelForumSeminarPeserta' => $searchModelForumSeminarPeserta,
		'dataProviderForumSeminarPeserta' => $dataProviderForumSeminarPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
