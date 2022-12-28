<?php


function sendMessage($telegram_id, $message_text, $meid)
{
    $url = "https://api.telegram.org/bot889705435:AAHn3CpJQLhGktaxJUGwZol1kbTVTMQa6qs/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message_text);
    $url = $url . "&reply_to_message_id=" . $meid;
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

function sendMessageT($telegram_id_t, $message_text, $meid)
{
    $url = "https://api.telegram.org/bot889705435:AAHn3CpJQLhGktaxJUGwZol1kbTVTMQa6qs/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id_t;
    $url = $url . "&text=" . urlencode($message_text);
    $url = $url . "&reply_to_message_id=" . $meid;
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

function sendChat($telegram_id, $message_text)
{
    $url = "https://api.telegram.org/bot889705435:AAHn3CpJQLhGktaxJUGwZol1kbTVTMQa6qs/sendMessage?chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message_text);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

function sendChatHtml($telegram_id, $message_text, $token = '889705435:AAHn3CpJQLhGktaxJUGwZol1kbTVTMQa6qs')
{
    $message_text = str_replace("&", "&amp", $message_text);
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message_text) . "&parse_mode=html";
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

function randoms_string($len = 10)
{
    $word = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function broadcast_amunisi($sales_id, $jenis)
{
    $ci = &get_instance();
    $dta = $ci->db->get_where('tb_sales', array('sales_id' => $sales_id))->row_array();
    $dtl      = $dta['datel'];
    $unit     = $dta['unit'];
    $pecahloc = explode(',', $dta['lat_long']);
    $lat      = str_replace(" ", "", $pecahloc[0]);
    $lng      = str_replace(" ", "", $pecahloc[1]);
    $salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

    $text = "ORDER\n";
    $text .= "JA$dta[sales_id] \n";
    $text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
    $text .= "CP : $dta[cp]\n";
    $text .= "ODP : $dta[odp]\n";
    $text .= "ALAMAT : $dta[alamat]\n";
    $text .= "JARAK TIANG : $dta[jarak_tiang]\n";
    $text .= "KATEGORI : <b>$dta[unit]</b> DEAL, ODP READY\n";
    $text .= "AMUNISI : <b>" . strtoupper($jenis) . "</b>\n";
    $text .= "MYIR : $dta[myir]\n";
    $text .= "PAKET : $dta[paket]\n";
    $text .= "SALES : $salesman\n";
    $text .= "KETERANGAN : $dta[keterangan]\n";
    $text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";

    $chatid = '';
    if ($unit == 'DCS') {
        switch ($dtl) {
            case 'PKL1':
                $chatid = -263944966;
                break;
            case 'PKL2':
                $chatid = -714329985;
                break;
            case 'BRB':
                $chatid = -341677349;
                break;
            case 'BTG':
                $chatid = -280898518;
                break;
            case 'TEG':
                $chatid = -338613303;
                break;
            case 'SLW':
                $chatid = -336766109;
                break;
            case 'PML':
                $chatid = -371367732;
                break;

            default:

                break;
        }
    } else {
        switch ($dtl) {
            case 'PKL1':
                $chatid = -770138148;
                break;
            case 'PKL2':
                $chatid = -644062746;
                break;
            case 'BRB':
                $chatid = -731237375;
                break;
            case 'BTG':
                $chatid = -669337165;
                break;
            case 'TEG':
                $chatid = -642556631;
                break;
            case 'SLW':
                $chatid = -696468812;
                break;
            case 'PML':
                $chatid = -709203943;
                break;

            default:

                break;
        }
    }

    sendChatHtml($chatid, $text);
}


function bCrypt($pass, $cost)
{
    $chars = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    // Build the beginning of the salt
    $salt = sprintf('$2a$%02d$', $cost);

    // Seed the random generator
    mt_srand();

    // Generate a random salt
    for ($i = 0; $i < 22; $i++) $salt .= $chars[mt_rand(0, 63)];

    // return the hash
    return crypt($pass, $salt);
}

function statusProvi($status_id)
{
    if ($status_id == 1) {
        return '<span class="label label-danger">waiting</span>';
    } else if ($status_id == 2) {
        return '<span class="label label-warning">ogp</span>';
    } else if ($status_id == 3) {
        return '<span class="label label-warning">fact</span>';
    } else if ($status_id == 4) {
        return "comp";
    } else if ($status_id == 5) {
        return '<span class="label label-warning">fdata</span>';
    } else if ($status_id == 6) {
        return  "live";
    } else if ($status_id == 7) {
        return "ps";
    }
}

if (!function_exists('date_indo')) {
    function date_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('bulan')) {
    function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

//Format Shortdate
if (!function_exists('shortdate_indo')) {
    function shortdate_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = short_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '/' . $bulan . '/' . $tahun;
    }
}

if (!function_exists('short_bulan')) {
    function short_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "01";
                break;
            case 2:
                return "02";
                break;
            case 3:
                return "03";
                break;
            case 4:
                return "04";
                break;
            case 5:
                return "05";
                break;
            case 6:
                return "06";
                break;
            case 7:
                return "07";
                break;
            case 8:
                return "08";
                break;
            case 9:
                return "09";
                break;
            case 10:
                return "10";
                break;
            case 11:
                return "11";
                break;
            case 12:
                return "12";
                break;
        }
    }
}

//Format Medium date
if (!function_exists('mediumdate_indo')) {
    function mediumdate_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = medium_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }
}

if (!function_exists('medium_bulan')) {
    function medium_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Ags";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}

//Long date indo Format
if (!function_exists('longdate_indo')) {
    function longdate_indo($tanggal)
    {
        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        return $nama_hari . ',' . $tgl . ' ' . $bulan . ' ' . $thn;
    }
}

function option_tahun()
{
    $y = date('Y');
    for ($i = 2019; $i <= $y; $i++) {
        echo "<option value=\"$i\">$i</option>";
    }
}

function option_bulan()
{
    $formattedMonthArray = array(
        "1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April",
        "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus",
        "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember",
    );
    for ($i = 1; $i <= 12; $i++) {
        echo "<option value=\"$i\">$formattedMonthArray[$i]</option>";
    }
}

function option_tahun_filtered($year)
{
    $y = date('Y');
    for ($i = 2019; $i <= $y; $i++) {
        if ($year == $i) {
            $ceked = "selected=\"selected\"";
        } else {
            $ceked = "";
        }
        echo "<option value=\"$i\" $ceked >$i</option>";
    }
}

function option_bulan_filtered($month)
{
    $formattedMonthArray = array(
        "1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April",
        "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus",
        "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember",
    );
    for ($i = 1; $i <= 12; $i++) {
        if ($month == $i) {
            $ceked = "selected=\"selected\"";
        } else {
            $ceked = "";
        }
        echo "<option value=\"$i\" $ceked >$formattedMonthArray[$i]</option>";
    }
}

function getKendala($kendala)
{
    if ($kendala == 'rna') {
        return 'RNA';
    } elseif ($kendala == 'alamat') {
        return 'ALAMAT';
    } elseif ($kendala == 'pending') {
        return 'PENDING';
    } elseif ($kendala == 'batal') {
        return 'BATAL';
    } elseif ($kendala == 'odp_loss') {
        return 'ODP LOSS';
    } elseif ($kendala == 'odp_full') {
        return 'ODP FULL';
    } elseif ($kendala == 'odp_reti') {
        return 'ODP RETI';
    } elseif ($kendala == 'odp_blm_live') {
        return 'ODP BLM LIVE';
    } elseif ($kendala == 'tiang') {
        return 'TIANG';
    } elseif ($kendala == 'pt_dua') {
        return 'PT2';
    } elseif ($kendala == 'no_fo') {
        return 'NO FO/ODP';
    } elseif ($kendala == 'rute') {
        return 'RUTE INSTALASI';
    } elseif ($kendala == 'njki') {
        return 'NJKI';
    } elseif ($kendala == 'ijin_tanam_tiang') {
        return 'IJIN TANAM TIANG';
    } elseif ($kendala == 'onu_32') {
        return 'ONU > 32';
    } elseif ($kendala == 'teknis') {
        return 'TEKNIS';
    } elseif ($kendala == 'pelanggan') {
        return 'PELANGGAN';
    } elseif ($kendala == 'installasi') {
        return 'INSTALLASI';
    } elseif ($kendala == 'maintenance') {
        return 'MAINTENANCE';
    } elseif ($kendala == 'terminate') {
        return 'TERMINATE';
    } elseif ($kendala == 'pending_instalasi') {
        return 'PENDING INSTALASI';
    } elseif ($kendala == 'unsc') {
        return 'UNSC';
    } else {
        return 'all';
    }
}

function getProgKendala($kendala)
{
    if ($kendala == 'RNA') {
        return 'rna';
    } elseif ($kendala == 'ALAMAT') {
        return 'alamat';
    } elseif ($kendala == 'PENDING') {
        return 'pending';
    } elseif ($kendala == 'BATAL') {
        return 'batal';
    } elseif ($kendala == 'ODP LOSS') {
        return 'odp_loss';
    } elseif ($kendala == 'ODP FULL') {
        return 'odp_full';
    } elseif ($kendala == 'ODP RETI') {
        return 'odp_reti';
    } elseif ($kendala == 'ODP BLM LIVE') {
        return 'odp_blm_live';
    } elseif ($kendala == 'TIANG') {
        return 'tiang';
    } elseif ($kendala == 'PT2') {
        return 'pt_dua';
    } elseif ($kendala == 'NO FO/ODP') {
        return 'no_fo';
    } elseif ($kendala == 'RUTE INSTALASI') {
        return 'rute';
    } elseif ($kendala == 'NJKI') {
        return 'njki';
    } elseif ($kendala == 'IJIN TANAM TIANG') {
        return 'ijin_tanam_tiang';
    } elseif ($kendala == 'ONU > 32') {
        return 'onu_32';
    } elseif ($kendala == 'TEKNIS') {
        return 'teknis';
    } elseif ($kendala == 'PELANGGAN') {
        return 'pelanggan';
    } elseif ($kendala == 'INSTALLASI') {
        return 'installasi';
    } elseif ($kendala == 'MAINTENANCE') {
        return 'maintenance';
    } elseif ($kendala == 'TERMINATE') {
        return 'terminate';
    } elseif ($kendala == 'PENDING INSTALASI') {
        return 'pending_instalasi';
    } else {
        return 'all';
    }
}

function getConstruction($cons)
{
    if ($cons == 'sp') {
        return '11';
    } elseif ($cons == 'deploy') {
        return '22';
    } elseif ($cons == 'golive') {
        return '33';
    } elseif ($cons == 'kc') {
        return '44';
    } elseif ($cons == 'redesain') {
        return '55';
    } elseif ($cons == 'approval_amo') {
        return '66';
    } elseif ($cons == 'next_project') {
        return '77';
    } elseif ($cons == 'selesai_golive') {
        return '88';
    } elseif ($cons == 'terminate') {
        return '99';
    } elseif ($cons == 'approval_datel') {
        return '10';
    } elseif ($cons == 'rejected_datel') {
        return '100';
    } else {
        return 'all';
    }
}

function progK($stat)
{
    if ($stat == 'APPROVAL AMO') {
        return 'approval_amo';
    } elseif ($stat == 'APPROVAL DATEL') {
        return 'approval_datel';
    } elseif ($stat == 'DEPLOY') {
        return 'deploy';
    } elseif ($stat == 'KENDALA JARINGAN') {
        return 'kendala_jaringan';
    } elseif ($stat == 'KENDALA PELANGGAN') {
        return 'kendala_pelanggan';
    } elseif ($stat == 'REDESAIN') {
        return 'redesain';
    } else {
        return 'all';
    }
}

function getLastProgKendala($stat)
{
    if ($stat == 'kd_3') {
        return '< 3 Hari';
    } elseif ($stat == 'kd_7') {
        return '< 7 Hari';
    } elseif ($stat == 'kd_14') {
        return '< 14 Hari';
    } elseif ($stat == 'kd_30') {
        return '< 30 Hari';
    } elseif ($stat == 'lb_30') {
        return '> 30 Hari';
    } else {
        return 'all';
    }
}

function getStatusKendala($status)
{
    if ($status == '0') {
        return 'BLM FU';
    } elseif ($status == '1') {
        return 'FU';
    } elseif ($status == '2') {
        return 'MANJA ULANG';
    } elseif ($status == '3') {
        return 'BATAL';
    } elseif ($status == '4') {
        return 'PENDING';
    } elseif ($status == '5') {
        return 'FU BY MAINTENANCE';
    } elseif ($status == '6') {
        return 'UNSC';
    }
}

function getStatusCons($status)
{
    if ($status == '11') {
        return 'SURVEY & PLAN';
    } elseif ($status == '22') {
        return 'DEPLOYMENT';
    } elseif ($status == '33') {
        return 'PROSES GOLIVE';
    } elseif ($status == '44') {
        return 'KENDALA GOLIVE';
    } elseif ($status == '55') {
        return 'REDESAIN';
    } elseif ($status == '66') {
        return 'APPROVAL AMO';
    } elseif ($status == '77') {
        return 'NEXT PROJECT';
    } elseif ($status == '88') {
        return 'SELESAI GOLIVE';
    } elseif ($status == '99') {
        return 'TERMINATE';
    } elseif ($status == '10') {
        return 'APPROVAL DATEL';
    } elseif ($status == '100') {
        return 'REJECTED DATEL';
    } else {
        return 'UNKNOWN';
    }
}

function getSegment($segment)
{
    if ($segment == 'psb') {
        return '0';
    } elseif ($segment == 'pda') {
        return '2';
    } elseif ($segment == 'addon') {
        return '3';
    } else {
        return 'all';
    }
}

function getIDSegment($segment)
{
    if ($segment == '0') {
        return 'psb';
    } elseif ($segment == '2') {
        return 'pda';
    } elseif ($segment == '3') {
        return 'addon';
    } else {
        return 'all';
    }
}

function getStatusProgress($sts)
{
    if ($sts == 'approval_amo') {
        return 'APPROVAL AMO';
    }
    if ($sts == 'approval_datel') {
        return 'APPROVAL DATEL';
    } elseif ($sts == 'deploy') {
        return 'DEPLOY';
    } elseif ($sts == 'kendala_jaringan') {
        return 'KENDALA JARINGAN';
    } elseif ($sts == 'kendala_pelanggan') {
        return 'KENDALA PELANGGAN';
    } elseif ($sts == 'redesain') {
        return 'REDESAIN';
    } elseif ($sts == 'proses_golive') {
        return 'PROSES GOLIVE';
    } elseif ($sts == 'kendala_golive') {
        return 'KENDALA GOLIVE';
    } else {
        return 'all';
    }
}

function getSegmentID($segment)
{
    if ($segment == 'psb') {
        return '0';
    } elseif ($segment == 'pda') {
        return '2';
    } elseif ($segment == 'addon') {
        return '3';
    } else {
        return 'all';
    }
}

function progress_deploy($status)
{
    if ($status == 'tunjuk_mitra') {
        return 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER';
    } elseif ($status == 'delivery_material') {
        return 'DELIVERY MATERIAL';
    } elseif ($status == 'tanam_tiang') {
        return 'PENANAMAN TIANG';
    } elseif ($status == 'tarik_kabel') {
        return 'PENARIKAN KABEL';
    } elseif ($status == 'install_odp') {
        return 'INSTALL ODP';
    } elseif ($status == 'penyambungan') {
        return 'PENYAMBUNGAN';
    } elseif ($status == 'selesai_fisik') {
        return 'SELESAI FISIK & MENUNGGU MAINCORE';
    } elseif ($status == 'perbaikan_mc') {
        return 'PERBAIKAN MAINCORE';
    } else {
        return 'ALL';
    }
}

function getstatusLog($status)
{
    if ($status == '1') {
        return 'WAITING';
    } elseif ($status == '2') {
        return 'ORDERED TO TEKNISI';
    } elseif ($status == '3') {
        return 'SET TO WAIT SC';
    } elseif ($status == '4') {
        return 'SET TO PROGRESS FCC';
    } elseif ($status == '5') {
        return 'SET TO DONE SC';
    } elseif ($status == '6') {
        return 'SET TO KENDALA';
    } elseif ($status == '7') {
        return 'SET TO HR';
    } elseif ($status == '8') {
        return 'SET TO FALLOUT';
    } elseif ($status == '9') {
        return 'SET TO COMPLETE';
    } elseif ($status == '10') {
        return 'SET TO PS';
    } elseif ($status == '11') {
        return 'KENDALA SET TO FOLLOW UP';
    } elseif ($status == '12') {
        return 'KENDALA SET TO MANJA ULANG';
    } elseif ($status == '13') {
        return 'KENDALA SET TO BATAL';
    } elseif ($status == '14') {
        return 'KENDALA SET TO PENDING';
    } elseif ($status == '15') {
        return 'KENDALA SET TO FOLLOW UP BY MAINTENANCE';
    } elseif ($status == '16') {
        return 'KENDALA SET TO UNSC';
    } elseif ($status == '17') {
        return 'ORDER SET TO UPDATE SC';
    } elseif ($status == '18') {
        return 'ORDER SET TO BLM DEPO';
    } elseif ($status == '19') {
        return 'ORDER SET TO KENDALA SC';
    } elseif ($status == '20') {
        return 'ORDER SET TO DONE INSTALL AP';
    } elseif ($status == '21') {
        return 'ORDER SET TO KENDALA PROVISIONING WMS';
    } elseif ($status == '22') {
        return 'ORDER SET TO WAIT FCC';
    } elseif ($status == '23') {
        return 'ORDER SET TO KENDALA FCC';
    } elseif ($status == '24') {
        return 'ORDER SET TO PROGRESS FCC';
    } elseif ($status == '25') {
        return 'ORDER SET TO SCBE';
    } elseif ($status == '26') {
        return 'ORDER SET TO PROGRESS CONSTRUCTION PT2 SIMPLE';
    } elseif ($status == '27') {
        return 'ORDER SET TO PROGRESS CONSTRUCTION PT2 PLUS';
    } elseif ($status == '28') {
        return 'ORDER SET TO PROGRESS CONSTRUCTION PT3';
    } elseif ($status == '29') {
        return 'UPDATE LOCATION REAL';
    } elseif ($status == '30') {
        return 'UPDATE KETERANGAN KENDALA';
    } elseif ($status == '31') {
        return 'ORDER CONSTRUCTION SET TO MANJA ULANG';
    } elseif ($status == '32') {
        return 'ORDER CONSTRUCTION SET TO KENDALA PELANGGAN BATAL';
    } elseif ($status == '33') {
        return 'ORDER CONSTRUCTION SET TO KENDALA TERMINATE';
    } elseif ($status == '34') {
        return 'ORDER CONSTRUCTION APPROVED BY AMO';
    } elseif ($status == '35') {
        return 'ORDER CONSTRUCTION REJECTED BY AMO';
    } elseif ($status == '36') {
        return 'ORDER CONSTRUCTION SET TO REDESAIN';
    } elseif ($status == '37') {
        return 'ORDER CONSTRUCTION SELESAI DEPLOYMENT (VALIDASI GOLIVE)';
    } elseif ($status == '38') {
        return 'ORDER CONSTRUCTION SET TO KENDALA GOLIVE';
    } elseif ($status == '39') {
        return 'ORDER CONSTRUCTION SET TO PERBAIKAN MAINCORE';
    } elseif ($status == '40') {
        return 'ORDER CONSTRUCTION SET TO SELESAI GOLIVE';
    } elseif ($status == '41') {
        return 'ORDER CONSTRUCTION SET TO PROSES GOLIVE';
    } elseif ($status == '42') {
        return 'ORDER CONSTRUCTION REDESAIN PUSH TO APPROVAL AMO';
    } elseif ($status == '43') {
        return 'KENDALA SET TO TDK TER FOLLOW UP';
    } elseif ($status == '44') {
        return 'ORDER CONSTRUCTION APPROVED BY DATEL';
    } elseif ($status == '45') {
        return 'ORDER CONSTRUCTION REJECTED BY DATEL';
    } elseif ($status == '111') {
        return 'UPDATE DATEL';
    }
}

if (!function_exists('set_datel')) {
    function set_datel($sto)
    {
        if ($sto == 'BTG' || $sto == 'SBA' || $sto == 'BDY') {
            return 'BTG';
        } elseif ($sto == 'PKL' || $sto == 'PKL1') {
            return 'PKL1';
        } elseif ($sto == 'KJE' || $sto == 'KDW' || $sto == 'PKL2') {
            return 'PKL2';
        } elseif ($sto == 'CMA' || $sto == 'RDD' || $sto == 'PML') {
            return 'PML';
        } elseif ($sto == 'BKA' || $sto == 'BMU' || $sto == 'TTL' || $sto == 'BRB' || $sto == 'KTM') {
            return 'BRB';
        } elseif ($sto == 'MGN' || $sto == 'TEG') {
            return 'TEG';
        } elseif ($sto == 'BLU' || $sto == 'SLW' || $sto == 'ADW') {
            return 'SLW';
        } else {
            return 'UNF';
        }
    }
}

if (!function_exists('datel_by_alamat')) {
    function datel_by_alamat($alamat)
    {

        $almt = strtolower($alamat);

        if (strpos($almt, 'batang') !== false || strpos($almt, 'subah') !== false || strpos($almt, 'bandarsedayu') !== false) {
            return 'BTG';
        } elseif (strpos($almt, 'pekalongan') !== false) {
            return 'PKL1';
        } elseif (strpos($almt, 'kajen') !== false || strpos($almt, 'kedungwuni') !== false) {
            return 'PKL2';
        } elseif (strpos($almt, 'comal') !== false || strpos($almt, 'randudongkal') !== false || strpos($almt, 'pemalang') !== false) {
            return 'PML';
        } elseif (strpos($almt, 'brebes') !== false) {
            return 'BRB';
        } elseif (strpos($almt, 'slawi') !== false || strpos($almt, 'adiwerna') !== false || strpos($almt, 'kab.tegal') !== false || strpos($almt, 'kab. tegal') !== false) {
            return 'SLW';
        } elseif (strpos($almt, 'margadana') !== false || strpos($almt, 'tegal') !== false) {
            return 'TEG';
        } else {
            return 'UNF';
        }
    }
}

if (!function_exists('distance')) {
    function distance($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'meters')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch ($unit) {
            case 'miles':
                break;
            case 'kilometers':
                $distance = $distance * 1.609344;
                break;
            case 'meters':
                $distance = $distance * 1609.344;
        }
        return (round($distance, 2));
    }
}

function getSalesman($kode)
{
    $ci = &get_instance();
    $sql = "SELECT * FROM tb_salesman WHERE kode = '$kode'";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->row();
        return $qr->kode . ' <a href="tg://openmessage?user_id=' . $qr->s_telegram_id . ' ">' . $qr->fullname . '</a> ' . $qr->no_hp;
    } else {
        return "NULL";
    }
}

function ct_row($datel)
{
    $ci = &get_instance();
    $sql = "SELECT COUNT(*) as total FROM tb_teknisi WHERE datel = '$datel' GROUP BY crew";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->row();
        return $qr->total;
    }
}

function getNameODP($odp)
{
    $ci = &get_instance();
    $sql = "SELECT odp_name FROM tb_odp_construction WHERE odp_id = '$odp'";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->row();
        return $qr->odp_name;
    }
}

function getTeknisi($t_telegram_id)
{
    $ci = &get_instance();
    $sql = "SELECT * FROM tb_teknisi WHERE t_telegram_id = '$t_telegram_id'";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->row();
        return $qr->nama_teknisi;
    } else {
        return "ALL Teknisi";
    }
}

function getProjectID($id)
{
    $ci = &get_instance();
    $sql = "SELECT project_code FROM tb_project WHERE project_id = '$id'";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->row();
        return $qr->project_code;
    } else {
        return "";
    }
}


function getTeknisibyCrew($crew)
{
    $ci = &get_instance();
    //$sql = "SELECT * FROM tb_teknisi WHERE crew = '$crew' AND libur NOT LIKE '%".date('d')."%' AND active = 1";
    $sql = "SELECT * FROM tb_teknisi WHERE crew = '$crew' AND active = 1";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->result();
        $something = " ";
        foreach ($qr as $row) {
            $something .= $row->nama_teknisi . ' , ';
        }
        return rtrim($something, ", ");
    } else {
        return "Teknisi tdk ditemukan.";
    }
}

function calculateDistanceBetweenTwoPoints($latitudeOne = '', $longitudeOne = '', $latitudeTwo = '', $longitudeTwo = '', $distanceUnit = 'MT', $round = false, $decimalPoints = '2')
{
    if (empty($decimalPoints)) {
        $decimalPoints = '3';
    }
    if (empty($distanceUnit)) {
        $distanceUnit = 'KM';
    }
    $distanceUnit = strtolower($distanceUnit);
    $pointDifference = $longitudeOne - $longitudeTwo;
    $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
    $toAcos = acos($toSin);
    $toRad2Deg = rad2deg($toAcos);

    $toMiles  =  $toRad2Deg * 60 * 1.1515;
    $toKilometers = $toMiles * 1.609344;
    $toNauticalMiles = $toMiles * 0.8684;
    $toMeters = $toKilometers * 1000;
    $toFeets = $toMiles * 5280;
    $toYards = $toFeets / 3;


    switch (strtoupper($distanceUnit)) {
        case 'ML': //miles
            $toMiles  = ($round == true ? round($toMiles) : round($toMiles, $decimalPoints));
            return $toMiles;
            break;
        case 'KM': //Kilometers
            $toKilometers  = ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
            return $toKilometers;
            break;
        case 'MT': //Meters
            $toMeters  = ($round == true ? round($toMeters) : round($toMeters, $decimalPoints));
            return $toMeters;
            break;
        case 'FT': //feets
            $toFeets  = ($round == true ? round($toFeets) : round($toFeets, $decimalPoints));
            return $toFeets;
            break;
        case 'YD': //yards
            $toYards  = ($round == true ? round($toYards) : round($toYards, $decimalPoints));
            return $toYards;
            break;
        case 'NM': //Nautical miles
            $toNauticalMiles  = ($round == true ? round($toNauticalMiles) : round($toNauticalMiles, $decimalPoints));
            return $toNauticalMiles;
            break;
    }
}

function time_progress_provi($time)
{
    if ($time == 'reorder') {
        return 'REORDER';
    } elseif ($time == 'as_exp') {
        return 'AS EXP';
    } elseif ($time == 'as_h_min_1') {
        return 'AS H-1';
    } elseif ($time == 'pagi') {
        return 'PAGI';
    } elseif ($time == 'sore') {
        return 'SORE';
    } elseif ($time == 'total_non_sore') {
        return 'Total Non Sore';
    } elseif ($time == 'total_sore') {
        return 'Total Sore';
    }
}

function kategori_progress($kategori)
{
    if ($kategori == 'wo') {
        return 'WO';
    } elseif ($kategori == 'ordered') {
        return 'ORDERED';
    } elseif ($kategori == 'otw') {
        return 'OTW';
    } elseif ($kategori == 'OGP') {
        return 'OGP';
    } elseif ($kategori == 'cek_onu') {
        return 'CEK ONU';
    } elseif ($kategori == 'hr_ont') {
        return 'HR ONT';
    } elseif ($kategori == 'p_nok') {
        return 'KENDALA PELANGGAN';
    } elseif ($kategori == 'j_nok') {
        return 'KENDALA JARINGAN';
    } elseif ($kategori == 'waitsc') {
        return 'WAIT SC';
    } elseif ($kategori == 'donesc') {
        return 'DONE SC';
    } elseif ($kategori == 'wait_act') {
        return 'WAIT ACT';
    } elseif ($kategori == 'prog_act') {
        return 'PROGRESS ACT';
    } elseif ($kategori == 'fact') {
        return 'FALLOUT';
    } elseif ($kategori == 'comp') {
        return 'ACT COMP';
    } elseif ($kategori == 'ps') {
        return 'PS';
    } elseif ($kategori == 'all_today') {
        return 'JOB TODAY';
    } elseif ($kategori == 'total_wo') {
        return 'TOTAL WO';
    } elseif ($kategori == 'total_prog') {
        return 'TOTAL PROGRESS';
    }
}

function datel_witel($datel)
{
    if ($datel == 'BRB') {
        return 'BREBES';
    } elseif ($datel == 'BTG') {
        return 'BATANG';
    } elseif ($datel == 'PKL1') {
        return 'PEKALONGAN 1';
    } elseif ($datel == 'PKL2') {
        return 'PEKALONGAN 2';
    } elseif ($datel == 'PML') {
        return 'PEMALANG';
    } elseif ($datel == 'SLW') {
        return 'SLAWI';
    } elseif ($datel == 'TEG') {
        return 'TEGAL';
    } else {
        return 'UNF';
    }
}

function add_on_type($type)
{
    $types = strtoupper($type);
    if (strpos($types, 'ADD POTS') !== false) {
        return 'ADD POTS';
    } elseif (strpos($types, 'ADD USEETV') !== false) {
        return 'ADD USEETV';
    } elseif (strpos($types, 'GANTI STB') !== false) {
        return 'GANTI STB';
    } elseif (strpos($types, '2NDSTB') !== false) {
        return '2NDSTB';
    } elseif (strpos($types, '3RDSTB') !== false) {
        return '3RDSTB';
    } elseif (strpos($types, 'EXTENDER') !== false) {
        return 'WIFI EXTENDER';
    } elseif (strpos($types, 'CAMERA') !== false) {
        return 'SMART CAMERA';
    } elseif (strpos($types, 'ADD INET+USEETV') !== false) {
        return 'ADD INET+USEETV';
    } elseif (strpos($types, 'ADD INET') !== false) {
        return 'ADD INET';
    } elseif (strpos($types, 'UPSPEED GANTI') !== false) {
        return 'UPSPEED GANTI ONT';
    } elseif (strpos($types, 'ADD STB+PLC') !== false) {
        return 'ADD STB+PLC';
    } else {
        return 'UNDEFINED';
    }
}

function list_odp_const($id)
{
    $ci = &get_instance();
    $sql = "SELECT * FROM tb_odp_construction WHERE project_id = '$id'";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->result();
        $something = "<ol>";
        foreach ($qr as $row) {
            $odp_plan = !empty($row->odp_live) ? $row->odp_live : 'No Data';
            $something .= '<li>' . $odp_plan . '</li>';
        }
        $something .= "</ol>";
        return $something;
    } else {
        return "Tidak ada ODP.";
    }
}

function list_odp_const_live($id)
{
    $ci = &get_instance();
    $sql = "SELECT * FROM tb_odp_construction WHERE project_id = '$id'";
    $q = $ci->db->query($sql);
    if ($q->num_rows() > 0) {
        $qr = $q->result();
        $something = '';
        foreach ($qr as $row) {
            $odp_plan = !empty($row->odp_name) ? $row->odp_name : 'No Data';
            $something .= '<div class="row"><div class="col-md-4"><input type="text" class="form-control" name="odp_plan-' . $row->odp_id . '" id="odp_plan-' . $row->odp_id . '" value="' . $row->odp_name . '"></div><div class="col-md-6"><input type="text" placeholder="Nama ODP untuk proses golive" class="form-control" name="odp_live-' . $row->odp_id . '" id="odp_live-' . $row->odp_id . '" value="' . $row->odp_live . '"></div><div class="col-md-2"><button onclick="change_odp(' . $row->odp_id . ')" class="btn btn-sm btn-success">Ubah</button></div></div>';
        }
        return $something;
    } else {
        return "Tidak ada ODP.";
    }
}

function send_amunisi_grup($datel, $unit)
{
    $chatid = '';
    if ($unit == 'DCS') {
        switch ($datel) {
            case 'PKL1':
                $chatid = -263944966;
                break;
            case 'PKL2':
                $chatid = -714329985;
                break;
            case 'BRB':
                $chatid = -341677349;
                break;
            case 'BTG':
                $chatid = -280898518;
                break;
            case 'TEG':
                $chatid = -338613303;
                break;
            case 'SLW':
                $chatid = -336766109;
                break;
            case 'PML':
                $chatid = -371367732;
                break;

            default:

                break;
        }
    } else {
        switch ($datel) {
            case 'PKL1':
                $chatid = -770138148;
                break;
            case 'PKL2':
                $chatid = -644062746;
                break;
            case 'BRB':
                $chatid = -731237375;
                break;
            case 'BTG':
                $chatid = -669337165;
                break;
            case 'TEG':
                $chatid = -642556631;
                break;
            case 'SLW':
                $chatid = -696468812;
                break;
            case 'PML':
                $chatid = -709203943;
                break;

            default:

                break;
        }
    }
    return $chatid;
}

function check_null_dashboard($data)
{
    if ($data == null || $data == 0 || $data == '0' || $data == '') {
        return "";
    } else {
        return $data;
    }
}

function check_unit_dcs_or_dbs($unit)
{
    if ($unit != 'DCS') {
        return 'DBS';
    } else {
        return $unit;
    }
}

function send_broadcast_tl($datel, $unit)
{
    $chatid = '';
    if ($unit == 'DCS') {
        switch ($datel) {
            case 'PKL1':
                $chatid = 77911094;
                break;
            case 'PKL2':
                $chatid = 77911094;
                break;
            case 'BTG':
                $chatid = 80369196;
                break;
            case 'PML':
                $chatid = 53443264;
                break;
            case 'TEG':
                $chatid = 62484322;
                break;
            case 'BRB':
                $chatid = 67504336;
                break;
            case 'SLW':
                $chatid = 65238609;
                break;

            default:
                $chatid = 91056926;
                break;
        }
    } else {
        switch ($datel) {
            case 'PKL1':
                $chatid = 77911094;
                break;
            case 'PKL2':
                $chatid = 77911094;
                break;
            case 'BTG':
                $chatid = 80369196;
                break;
            case 'PML':
                $chatid = 53443264;
                break;
            case 'TEG':
                $chatid = 62484322;
                break;
            case 'BRB':
                $chatid = 67504336;
                break;
            case 'SLW':
                $chatid = 65238609;
                break;

            default:
                $chatid = 91056926;
                break;
        }
    }
    return $chatid;
}
