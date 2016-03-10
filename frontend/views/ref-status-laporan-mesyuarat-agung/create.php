<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusLaporanMesyuaratAgung */

$this->title = 'Create Ref Status Laporan Mesyuarat Agung';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Laporan Mesyuarat Agungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-laporan-mesyuarat-agung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
