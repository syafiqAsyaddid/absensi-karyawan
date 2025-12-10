<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi <?= date("F", mktime(0, 0, 0, $data['month'], 10)); ?> <?= $data['year']; ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 11px; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        h2, h4 { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 4px; text-align: center; }
        th { background-color: #f0f0f0; font-weight: bold; }
        .text-left { text-align: left; }
        .s-hadir { background-color: #d1fae5; color: #065f46; font-weight: bold; } /* Hijau Muda */
        .s-izin { background-color: #ffedd5; color: #9a3412; } /* Oranye */
        .s-sakit { background-color: #dbeafe; color: #1e40af; } /* Biru */
        .s-alpha { background-color: #fee2e2; color: #991b1b; font-weight: bold; } /* Merah */
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <button class="no-print" onclick="window.close()" style="padding: 10px 20px; margin-bottom: 20px; cursor:pointer; background-color: #ddd; border: 1px solid #999; border-radius: 5px;">
        Tutup / Kembali
    </button>

    <div class="header">
        <h2>LAPORAN REKAPITULASI KEHADIRAN</h2>
        <h4>Periode: <?= date("F", mktime(0, 0, 0, $data['month'], 10)); ?> <?= $data['year']; ?></h4>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" width="30">No</th>
                <th rowspan="2" width="150">Nama Karyawan</th>
                <?php $days = cal_days_in_month(CAL_GREGORIAN, $data['month'], $data['year']); ?>
                <th colspan="<?= $days; ?>">Tanggal</th>
                <th colspan="3">Total</th>
            </tr>
            <tr>
                <?php for($d=1; $d<=$days; $d++): ?>
                    <th width="20" style="font-size: 9px;"><?= $d; ?></th>
                <?php endfor; ?>
                <th width="30" style="background:#d1fae5">H</th>
                <th width="30" style="background:#ffedd5">I/S</th>
                <th width="30" style="background:#fee2e2">A</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data['employees'] as $emp): 
                $h=0; $i=0; $a=0;
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td class="text-left" style="padding-left:5px;"><b><?= $emp['nama']; ?></b></td>
                
                <?php for($d=1; $d<=$days; $d++): 
                    $status = $data['matrix'][$emp['id']][$d] ?? '-';
                    $class = '';
                    $code = '';

                    if($status == 'Hadir') { $class='s-hadir'; $code='•'; $h++; }
                    elseif($status == 'Izin') { $class='s-izin'; $code='I'; $i++; }
                    elseif($status == 'Sakit') { $class='s-sakit'; $code='S'; $i++; }
                    elseif($status == 'Alpha') { $class='s-alpha'; $code='A'; $a++; }
                ?>
                    <td class="<?= $class; ?>"><?= $code; ?></td>
                <?php endfor; ?>

                <td style="font-weight:bold;"><?= $h; ?></td>
                <td style="font-weight:bold;"><?= $i; ?></td>
                <td style="font-weight:bold;"><?= $a; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 30px; float: right; text-align: center; width: 200px;">
        <p>Bogor, <?= date('d F Y'); ?></p>
        <p style="margin-top: 60px;">( __________________ )</p>
        <p>HR Manager</p>
    </div>
</body>
</html>