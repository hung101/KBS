<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTujuanUjianFisiologi */

$this->title = 'Create Ref Tujuan Ujian Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tujuan Ujian Fisiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tujuan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
