<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanPemeriksa */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-pemeriksa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
