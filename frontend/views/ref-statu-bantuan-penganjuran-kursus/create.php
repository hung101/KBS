<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenganjuranKursus */

$this->title = 'Create Ref Status Bantuan Penganjuran Kursus';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penganjuran Kursuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-bantuan-penganjuran-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
