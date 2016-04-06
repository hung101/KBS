<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rehabilitasi */

$this->title = GeneralLabel::tambah_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
