<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianRekods */

$this->title = 'Tambah Keputusan';
$this->params['breadcrumbs'][] = ['label' => 'Keputusan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-rekods-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
