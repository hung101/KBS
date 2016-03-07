<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkpProgram */

//$this->title = 'Update Pengurusan Jkk Jkp Program: ' . ' ' . $model->pengurusan_jkk_jkp_program_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan JKK/JKP Program';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan JKK/JKP Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan JKK/JKP Program', 'url' => ['view', 'id' => $model->pengurusan_jkk_jkp_program_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelSenaraiAtlet' => $searchModelSenaraiAtlet,
        'dataProviderSenaraiAtlet' => $dataProviderSenaraiAtlet,
        'searchModelSenaraiJurulatih' => $searchModelSenaraiJurulatih,
        'dataProviderSenaraiJurulatih' => $dataProviderSenaraiJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>
