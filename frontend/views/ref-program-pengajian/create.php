<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgramPengajian */

$this->title = 'Create Ref Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
