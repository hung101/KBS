<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenganjuranKejohanan */

$this->title = 'Create Ref Status Bantuan Penganjuran Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
