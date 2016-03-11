<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusAduanPenyertaanSukan */

$this->title = 'Create Ref Status Aduan Penyertaan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Aduan Penyertaan Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-aduan-penyertaan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
