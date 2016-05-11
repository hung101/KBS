<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPenggunaEKemudahan */

$this->title = 'Create Ref Jenis Pengguna Ekemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Pengguna Ekemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-pengguna-ekemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
