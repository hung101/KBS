<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SoalanPenilaian */

$this->title = 'Tambah Soalan Penilaian';
$this->params['breadcrumbs'][] = ['label' => 'Soalan Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soalan-penilaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
