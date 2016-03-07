<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramPersatuan */

$this->title = 'Tambah Pengurusan Program Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Persatuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
