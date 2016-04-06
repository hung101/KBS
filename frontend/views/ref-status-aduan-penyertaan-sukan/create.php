<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusAduanPenyertaanSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_aduan_penyertaan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_aduan_penyertaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-aduan-penyertaan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
