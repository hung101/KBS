<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CadanganElaun */

$this->title = GeneralLabel::tambah_cadangan_elaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cadangan_elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadangan-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
