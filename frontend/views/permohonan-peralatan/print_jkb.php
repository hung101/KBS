<?php
//count how many outer loop
$limitItem = 5;
$outerLoop = ceil(count($peralatan)/$limitItem);

?>

<!DOCTYPE html>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    PERMOHONAN JAWATANKUASA BANTUAN<br />
    BAHAGIAN ATLET<br />
    MAJLIS SUKAN NEGARA
    </div>
    
    <table class="aTable" cellspacing="0" cellpadding="0">
      <tr>
        <th rowspan="2">BIL</th>
        <th rowspan="2">AKTIVITI</th>
        <th rowspan="2">I) NEGERI<br>II) TARIKH<br>III) LAIN-LAIN</th>
        <th colspan="3">PERMOHONAN</th>
        <th colspan="3">CADANGAN</th>
      </tr>
      <tr>
        <th>PERBELANJAAN DIPOHON</th>
        <th>JUMLAH</th>
        <th>CATATAN</th>
        <th>ANGGARAN PERBELANJAAN</th>
        <th>JUMLAH</th>
        <th>CATATAN</th>
      </tr>
      <?php
      $grandTotalPohon = 0;
      $grandTotalCadang = 0;
      for($o = 1; $o <= $outerLoop; $o++)
      {
        $borderStyle = "border-top:0;border-bottom:0";
        $aktiviti = null;
        $sukan = null;
        $negeri = null;
		$cawangan = null;
        $tarikh_permohonan = null;
        $bil = null;
        
        if($o === 1) {
          $bil = '1.';
          $aktiviti = $model->aktiviti;
          $sukan = $model->sukan;
          $negeri = $model->negeri;
		  if(isset($model->tarikh) && $model->tarikh != null){
			  $tarikh_permohonan = date('d.m.Y', strtotime($model->tarikh));
		  }
		  $cawangan = $model->cawangan;
        }
		
        if($o === (int)$outerLoop){
              $borderStyle = "border-top:0;border-bottom:1px solid";
        }
      ?>
        <tr>
            <td class="align-top" style="<?= $borderStyle ?>"><?= $bil ?></td>
            <td class="align-top" style="<?= $borderStyle ?>">
            <?php
            if ($aktiviti != null)
            {
                echo $aktiviti;
            }
            ?><br /><br /><br />
            <div style="margin:40px 0px 0px"><?php if($o === 1) echo 'Sukan:<br />'.$sukan ?></div>
            </td>
            <td class="align-top text-left" style="<?= $borderStyle ?>">
            <?php
            if ($negeri != null) {
                echo 'I) '.$negeri;
            }
            if ($tarikh_permohonan != null) {
                echo '<br />II) '.$tarikh_permohonan;
            }
            if ($cawangan != null) {
                echo '<br />III) Cawangan: '.$cawangan;
            }
            ?>
            </td>
            <td class="align-top" style="<?= $borderStyle ?>">
            <?php
            $innerLoopLimit = $o*$limitItem;
            if(count($peralatan) < $innerLoopLimit) { $innerLoopLimit = count($peralatan); }
            $innerStart = 0;
            if(isset($i)){ $innerStart = $i; }
            for($i=$innerStart; $i < $innerLoopLimit; $i++)
            {
                $grandTotalPohon = $grandTotalPohon+$peralatan[$i]['jumlah'];
                ?>
                <div style="margin-bottom:50px">
                <?= $i+1 ?>. <?= $peralatan[$i]['nama_peralatan'] ?> - <?= $peralatan[$i]['spesifikasi'] ?><br />
                <?php
                if($peralatan[$i]['harga_per_unit'] != null || $peralatan[$i]['harga_per_unit'] != '')
                {
                    echo 'RM '.$peralatan[$i]['harga_per_unit'];
                }
                if($peralatan[$i]['jumlah_unit'] != null || $peralatan[$i]['jumlah_unit'] != '')
                {
                    echo ' x '.$peralatan[$i]['jumlah_unit'];
                }
                if($peralatan[$i]['bilangan'] != null || $peralatan[$i]['bilangan'] != '')
                {
                    echo ' x '.$peralatan[$i]['bilangan'];
                }
                ?>
                    <br />Jumlah: RM <?= $peralatan[$i]['jumlah'] ?><br /><br />
                </div>
                <?php
                
            }
            ?>
            </td>
            <td class="align-bottom text-bold" style="<?= $borderStyle ?>">
            <?php
            if($o === (int)$outerLoop)
            {
                echo 'RM '.number_format((float)$grandTotalPohon, 2, '.', '');
            }
            ?>
            </td>
            <td valign="top" style="<?= $borderStyle ?>">
                <?php
                $innerLoopLimit = $o*$limitItem;
                if(count($peralatan) < $innerLoopLimit) { $innerLoopLimit = count($peralatan); }
                $innerStarty = 0;
                if(isset($y)){ $innerStarty = $y; }
                for($y=$innerStarty; $y < $innerLoopLimit; $y++)
                {
                    echo $peralatan[$y]['catatan'].'<br /><br /><br /><br /><br />';
                }
                ?>
            </td>
            <td class="align-top" style="<?= $borderStyle ?>">
            <?php
            $innerLoopLimit = $o*$limitItem;
            if(count($peralatan) < $innerLoopLimit) { $innerLoopLimit = count($peralatan); }
            $innerStartZ = 0;
            if(isset($z)){ $innerStartZ = $z; }
            for($z=$innerStartZ; $z < $innerLoopLimit; $z++)
            {
                $grandTotalCadang = $grandTotalCadang+$peralatan[$z]['jumlah_cadangan'];
                ?>
                <div style="margin-bottom:50px">
                <?= $z+1 ?>. <?= $peralatan[$z]['nama_peralatan'] ?> - <?= $peralatan[$z]['spesifikasi'] ?><br />
                <?php
                if($peralatan[$z]['harga_per_unit_cadangan'] != null || $peralatan[$z]['harga_per_unit_cadangan'] != '')
                {
                    echo 'RM '.$peralatan[$z]['harga_per_unit_cadangan'];
                }
                if($peralatan[$z]['jumlah_unit_cadangan'] != null || $peralatan[$z]['jumlah_unit_cadangan'] != '')
                {
                    echo ' x '.$peralatan[$z]['jumlah_unit_cadangan'];
                }
                if($peralatan[$z]['bilangan_cadangan'] != null || $peralatan[$z]['bilangan_cadangan'] != '')
                {
                    echo ' x '.$peralatan[$z]['bilangan_cadangan'];
                }
                ?>
                    <br />Jumlah: RM <?= $peralatan[$z]['jumlah_cadangan'] ?><br /><br />
                </div>
                <?php
            }
            ?>
            </td>
            <td class="align-bottom text-bold" style="<?= $borderStyle ?>">
            <?php
            if($o === (int)$outerLoop)
            {
                echo 'RM '.number_format((float)$grandTotalCadang, 2, '.', '');
            }
            ?>
            </td>
            <td valign="top" style="<?= $borderStyle ?>">
                <?php
                $innerLoopLimit = $o*$limitItem;
                if(count($peralatan) < $innerLoopLimit) { $innerLoopLimit = count($peralatan); }
                $innerStartZZ = 0;
                if(isset($ZZ)){ $innerStartZZ = $ZZ; }
                for($ZZ=$innerStartZZ; $ZZ < $innerLoopLimit; $ZZ++)
                {
                    echo $peralatan[$ZZ]['catatan_cadangan'].'<br /><br /><br /><br /><br />';
                }
                ?>
            </td>
        </tr>
      <?php
      }
      ?>
    </table>
</body>
</html>