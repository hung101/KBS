<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkpProgram */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_jkkjkp_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jkkjkp_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-program-create">

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
