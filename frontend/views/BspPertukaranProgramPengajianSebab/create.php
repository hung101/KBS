<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianSebab */

$this->title = 'Tambah Sebab Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Sebab Pertukaran Program Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-sebab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
