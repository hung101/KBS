<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\webdelete()\View */
/* @var $model app\models\PengurusanAnjuran */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_anjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_anjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-anjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanAnjuranNegara' => $searchModelPengurusanAnjuranNegara,
        'dataProviderPengurusanAnjuranNegara' => $dataProviderPengurusanAnjuranNegara,
        'readonly' => $readonly,
    ]) ?>

</div>
