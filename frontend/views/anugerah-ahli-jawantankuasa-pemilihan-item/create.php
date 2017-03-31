<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanAtlet */

$this->title = 'Create Anugerah Ahli Jawatankuasa Pemilihan Item';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Ahli Jawatankuasa Pemilihan Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-item-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
