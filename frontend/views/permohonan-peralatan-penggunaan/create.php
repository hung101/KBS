<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatanPenggunaan */

$this->title = 'Create Permohonan Peralatan Penggunaan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Peralatan Penggunaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-peralatan-penggunaan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
