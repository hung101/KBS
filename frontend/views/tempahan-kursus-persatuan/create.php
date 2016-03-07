<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempahanKursusPersatuan */

$this->title = 'Tambah Tempahan Kursus Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Tempahan Kursus Persatuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kursus-persatuan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
