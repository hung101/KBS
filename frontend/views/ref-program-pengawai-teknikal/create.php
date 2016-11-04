<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgramPengawaiTeknikal */

$this->title = 'Create Ref Program Pengawai Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Pengawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-pengawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
