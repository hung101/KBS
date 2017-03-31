<?php
if(isset($model->tarikh))
{
    $model->tarikh = date('d/m/Y',strtotime($model->tarikh));
}
?>
<table align="center" width="80%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="right"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="120"></td>
        <td>&nbsp;</td>
        <td><b style="font-size:26px">PERMOHONAN/PENERIMAAN PERALATAN</b></td>
    </tr>
</table>


<table style="margin-top:10px">
    <tr>
        <td>UNIT / NEGERI</td><td>:</td><td><?= $model->negeri ?></td>
    </tr>
    <tr>
        <td>SUKAN</td><td>:</td><td><?= $model->sukan ?></td>
    </tr>
    <tr>
        <td>TARIKH</td><td>:</td><td><?= $model->tarikh ?></td>
    </tr>
    <tr>
        <td>ALASAN / AKTIVITI</td><td>:</td><td><?= $model->aktiviti ?></td>
    </tr>
</table>

<table style="margin-top:10px;" border="1" width="100%" cellpadding="4" cellspacing="0">
    <tr>
        <th>BIL</th>
        <th>PERKARA / PERALATAN</th>
        <th>SPESIFIKASI</th>
        <th>HARGA UNIT (RM)</th>
        <th>JUMLAH UNIT</th>
        <th>BILANGAN</th>
        <th>JUMLAH (RM)</th>
        <th>CATATAN</th>
    </tr>
    <?php
    $counter = 1;
    $totalHargaUnit = 0;
    $totalUnit = 0;
    $totalBil = 0;
    $grandTotal = 0;
    foreach($peralatan as $item){
        $totalHargaUnit = $totalHargaUnit+$item->harga_per_unit;
        $totalUnit = $totalUnit+$item->jumlah_unit;
        $totalBil = $totalBil+$item->bilangan;
        $grandTotal = $grandTotal+$item->jumlah;
    ?>
    <tr>
        <td align="center"><?= $counter ?></td>
        <td><?= $item->nama_peralatan ?></td>
        <td><?= $item->spesifikasi ?></td>
        <td><?= $item->harga_per_unit ?></td>
        <td align="center"><?= $item->jumlah_unit ?></td>
        <td align="center"><?= $item->bilangan ?></td>
        <td><?= $item->jumlah ?></td>
        <td><?= $item->catatan ?></td>
    </tr>
    <?php
    $counter++;
    }
    ?>
    <tr>
        <td colspan="3" align="right">
            <b>JUMLAH</b>
        </td>
        <td><?= number_format((float)$totalHargaUnit, 2, '.', '') ?></td>
        <td align="center"><?= $totalUnit ?></td>
        <td align="center"><?= $totalBil ?></td>
        <td><?= number_format((float)$grandTotal, 2, '.', '') ?></td>
        <td></td>
    </tr>
</table>
<table style="margin-top:10px">
    <tr>
        <td>NOTA URUS SETIA</td><td>:</td><td><?= $model->nota_urus_setia ?></td>
    </tr>
</table>

<table style="margin-top:20px" border="0" align="right">
    <tr>
        <td>______________________________________________</td>
    </tr>
    <tr>
        <td align="center">(Tandatangan Penerima)</td>
    </tr>
</table>

<table style="" border="0" align="right" width="60%">
    <tr>
        <td align="right">Nama</td>
        <td width="1%">:</td>
        <td width="69%"></td>
    </tr>
    <tr>
        <td align="right">Jawatan</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td align="right">Tarikh</td>
        <td>:</td>
        <td></td>
    </tr>
</table>

