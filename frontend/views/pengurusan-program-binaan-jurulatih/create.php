<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanJurulatih */

$this->title = 'Create Pengurusan Program Binaan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
