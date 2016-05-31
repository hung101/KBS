<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriSoalanPenganjur */

$this->title = 'Create Ref Kategori Soalan Penganjur';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Soalan Penganjurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-soalan-penganjur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
