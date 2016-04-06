<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InformasiPersatuan */

$this->title = GeneralLabel::tambah_informasi_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::informasi_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
