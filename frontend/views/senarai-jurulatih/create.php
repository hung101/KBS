<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SenaraiJurulatih */

$this->title = 'Tambah Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
