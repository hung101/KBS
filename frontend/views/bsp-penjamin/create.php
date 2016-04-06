<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */

$this->title = GeneralLabel::createTitle . ' Penjamin Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penjamin_biasiswa_sukan_persekutuan, 'url' => Url::to(['index', 'bsp_pemohon_id' => $bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
