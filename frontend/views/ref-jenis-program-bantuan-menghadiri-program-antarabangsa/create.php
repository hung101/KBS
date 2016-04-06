<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisProgramBantuanMenghadiriProgramAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_program_bantuan_menghadiri_program_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_program_bantuan_menghadiri_program_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-program-bantuan-menghadiri-program-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
