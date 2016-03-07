<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAduan */

$this->title = 'Penambahan Aduan';
$this->params['breadcrumbs'][] = ['label' => 'Aduan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
