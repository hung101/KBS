<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPersidanganDiLuarNegara */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_menghadiri_program_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_menghadiri_program_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-persidangan-di-luar-negara-create">

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
