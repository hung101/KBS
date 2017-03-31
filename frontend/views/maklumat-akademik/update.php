<?php

use yii\helpers\Html;
// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademik */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::maklumat_akademik_small;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_akademik_small, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_akademik_small, 'url' => ['view', 'id' => $model->maklumat_akademik_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'searchModelMaklumatAkademikJadual' => $searchModelMaklumatAkademikJadual,
		'dataProviderMaklumatAkademikJadual' => $dataProviderMaklumatAkademikJadual,
		'searchModelMaklumatAkademikSubjek' => $searchModelMaklumatAkademikSubjek,
		'dataProviderMaklumatAkademikSubjek' => $dataProviderMaklumatAkademikSubjek,
		'readonly' => $readonly,
    ]) ?>

</div>
