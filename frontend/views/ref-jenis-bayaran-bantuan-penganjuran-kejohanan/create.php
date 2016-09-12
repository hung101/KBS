<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBayaranBantuanPenganjuranKejohanan */

$this->title = 'Create Ref Jenis Bayaran Bantuan Penganjuran Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bayaran Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bayaran-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
