<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanKesihatan */

$this->title = GeneralLabel::createTitle . ' Permohonan Program Pendidikan Kesihatan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Program Pendidikan Kesihatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-kesihatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
