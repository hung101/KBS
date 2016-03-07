<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKelayakanJaringanAntarabangsa */

$this->title = GeneralLabel::createTitle . ' Pengurusan Kelayakan Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kelayakan Jaringan Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kelayakan-jaringan-antarabangsa-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
