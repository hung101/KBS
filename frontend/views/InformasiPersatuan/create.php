<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InformasiPersatuan */

$this->title = 'Tambah Informasi Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Informasi Persatuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
