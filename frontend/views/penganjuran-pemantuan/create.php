<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranPemantuan */

$this->title = GeneralLabel::pengamjuran_pemantuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengamjuran_pemantuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-pemantuan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
