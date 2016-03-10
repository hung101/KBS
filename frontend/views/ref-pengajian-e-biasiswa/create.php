<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPengajianEBiasiswa */

$this->title = 'Create Ref Pengajian Ebiasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pengajian Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pengajian-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
