<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanDanPeralatan */

$this->title = GeneralLabel::createTitle . ' Pengurusan Kemudahan Dan Peralatan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_dan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-dan-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
