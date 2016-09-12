<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubElemenBantuanPenganjuranKejohanan */

$this->title = 'Create Ref Sub Elemen Bantuan Penganjuran Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sub Elemen Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
