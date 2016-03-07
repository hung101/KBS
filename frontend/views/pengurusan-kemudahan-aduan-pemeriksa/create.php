<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanPemeriksa */

$this->title = GeneralLabel::createTitle . ' Pengurusan Kemudahan Aduan Pemeriksa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-pemeriksa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
