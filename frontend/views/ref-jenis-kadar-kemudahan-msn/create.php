<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKadarKemudahanMsn */

$this->title = 'Create Ref Jenis Kadar Kemudahan Msn';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kadar Kemudahan Msns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kadar-kemudahan-msn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
