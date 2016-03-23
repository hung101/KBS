<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMouMoaAntarabangsa */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_mou_moa_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_mou_moa_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-mou-moa-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
