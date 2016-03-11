<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiKejohananTemasya */

$this->title = 'Create Ref Pegawai Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-kejohanan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
