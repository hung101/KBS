<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KemudahPakaianPeralatanTiket */

$this->title = 'Kemudahan Pakaian/Peralatan/Tiket Kapal Terbang';
$this->params['breadcrumbs'][] = ['label' => 'Kemudahan Pakaian/Peralatan/Tiket Kapal Terbang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kemudah-pakaian-peralatan-tiket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
