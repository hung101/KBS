<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BorangPermohonanKem */

$this->title = 'Tambah Borang Permohonan Kem';
$this->params['breadcrumbs'][] = ['label' => 'Borang Permohonan Kem', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-permohonan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
