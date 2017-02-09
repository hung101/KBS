<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */

$this->title = 'Tambah Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Pertukaran Program Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
