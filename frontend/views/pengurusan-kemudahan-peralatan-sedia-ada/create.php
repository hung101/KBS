<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanPeralatanSediaAda */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-peralatan-sedia-ada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
