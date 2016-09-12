<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSumberKewanganBantuanPenganjuranKejohanan */

$this->title = 'Create Ref Sumber Kewangan Bantuan Penganjuran Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sumber Kewangan Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sumber-kewangan-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
