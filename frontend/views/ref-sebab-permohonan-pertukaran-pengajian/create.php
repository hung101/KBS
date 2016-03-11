<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSebabPermohonanPertukaranPengajian */

$this->title = 'Create Ref Sebab Permohonan Pertukaran Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sebab Permohonan Pertukaran Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sebab-permohonan-pertukaran-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
