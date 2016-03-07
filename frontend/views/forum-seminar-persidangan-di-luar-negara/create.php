<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPersidanganDiLuarNegara */

$this->title = GeneralLabel::createTitle . ' Bantuan Menghadiri Program Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Menghadiri Program Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-persidangan-di-luar-negara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInformasiPermohonanProgramAntarabangsa' => $searchModelInformasiPermohonanProgramAntarabangsa,
        'dataProviderInformasiPermohonanProgramAntarabangsa' => $dataProviderInformasiPermohonanProgramAntarabangsa,
        'readonly' => $readonly,
    ]) ?>

</div>
