<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPensijilanAkademiAkk */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Pensijilan Akademi Akk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pensijilan Akademi Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pensijilan-akademi-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
