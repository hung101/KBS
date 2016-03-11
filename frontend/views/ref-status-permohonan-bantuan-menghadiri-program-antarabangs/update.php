<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanBantuanMenghadiriProgramAntarabangs */

$this->title = 'Update Ref Status Permohonan Bantuan Menghadiri Program Antarabangs: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Bantuan Menghadiri Program Antarabangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-permohonan-bantuan-menghadiri-program-antarabangs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
