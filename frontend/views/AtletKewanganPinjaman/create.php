<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganPinjaman */

$this->title = 'Tambah Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-pinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
