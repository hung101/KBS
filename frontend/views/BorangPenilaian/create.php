<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaian */

$this->title = 'Tambah Borang Penilaian';
$this->params['breadcrumbs'][] = ['label' => 'Borang Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
