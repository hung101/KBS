<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenGeranBantuanGaji */

$this->title = 'Create Ref Dokumen Geran Bantuan Gaji';
$this->params['breadcrumbs'][] = ['label' => 'Ref Dokumen Geran Bantuan Gajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-geran-bantuan-gaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
