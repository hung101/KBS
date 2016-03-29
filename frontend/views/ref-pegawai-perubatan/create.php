<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPerubatan */

$this->title = 'Create Ref Pegawai Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
