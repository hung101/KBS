<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefElemenBantuanPenganjuranKejohanan */

$this->title = 'Create Ref Elemen Bantuan Penganjuran Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Elemen Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-elemen-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
