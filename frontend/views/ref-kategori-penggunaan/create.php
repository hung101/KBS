<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPenggunaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_penggunaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_penggunaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-penggunaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
