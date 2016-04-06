<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanBantuanMenghadiriProgramAntarabangs */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Bantuan Menghadiri Program Antarabangs';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Bantuan Menghadiri Program Antarabangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-bantuan-menghadiri-program-antarabangs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
