<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanAtlet */

$this->title = 'Create Anugerah Ahli Jawatankuasa Pengelola Item';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Ahli Jawatankuasa Pengelola Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pengelola-item-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
