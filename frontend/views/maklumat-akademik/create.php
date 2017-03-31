<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademik */

$this->title = GeneralLabel::tambah.' '.GeneralLabel::maklumat_akademik_small;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_akademik_small, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-create">

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
