<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefWaktuKetikaDiperlukanSukarelawan */

$this->title = GeneralLabel::createTitle.' '.'Ref Waktu Ketika Diperlukan Sukarelawan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Waktu Ketika Diperlukan Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-waktu-ketika-diperlukan-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
