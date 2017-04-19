<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisProgramBantuanMenghadiriProgramAntarabangsa */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jenis_program_bantuan_menghadiri_program_antarabangsa.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_program_bantuan_menghadiri_program_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-jenis-program-bantuan-menghadiri-program-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
