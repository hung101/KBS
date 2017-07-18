<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKejohananTemasya */

$this->title = 'Create Ref Kategori Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kejohanan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
