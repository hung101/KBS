<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanKerosakan */

$this->title = 'Tambah Pengurusan Kemudahan Aduan Kerosakan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan Aduan Kerosakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-kerosakan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
