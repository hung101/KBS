<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriServisSub */

$this->title = 'Create Ref Kategori Servis Sub';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Servis Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-servis-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
