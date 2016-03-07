<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jurulatih */

$this->title = 'Tambah Maklumat Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
