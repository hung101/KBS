<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPerubatanFisioterapi */

$this->title = 'Create Ref Pegawai Perubatan Fisioterapi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Perubatan Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-perubatan-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
