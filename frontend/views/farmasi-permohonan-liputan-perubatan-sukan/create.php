<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPermohonanLiputanPerubatanSukan */

$this->title = GeneralLabel::createTitle . ' Permohonan Liputan Perubatan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Liputan Perubatan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-liputan-perubatan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
