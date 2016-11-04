<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPengawaiTeknikal */

$this->title = 'Create Ref Jawatan Pengawai Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Pengawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-pengawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
