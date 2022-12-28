
function getstatusLog(status)
{
    if (status == '1') {
        return 'WAITING';
    }
    else if (status == '2') {
        return 'ORDERED TO TEKNISI';
    }
    else if (status == '3') {
        return 'SET TO WAIT SC';
    }
    else if (status == '4') {
        return 'SET TO PROGRESS FCC';
    }
    else if (status == '5') {
        return 'SET TO DONE SC';
    }
    else if (status == '6') {
        return 'SET TO KENDALA';
    }
    else if (status == '7') {
        return 'SET TO HR';
    }
    else if (status == '8') {
        return 'SET TO FALLOUT';
    }
    else if (status == '9') {
        return 'SET TO COMPLETE';
    }
    else if (status == '10') {
        return 'SET TO PS';
    }
    else if (status == '11') {
        return 'KENDALA SET TO FOLLOW UP';
    }
    else if (status == '12') {
        return 'KENDALA SET TO MANJA ULANG';
    }
    else if (status == '13') {
        return 'KENDALA SET TO BATAL';
    }
    else if (status == '14') {
        return 'KENDALA SET TO PENDING';
    }
    else if (status == '15') {
        return 'KENDALA SET TO FOLLOW UP BY MAINTENANCE';
    }
    else if (status == '16') {
        return 'KENDALA SET TO UNSC';
    }
    else if (status == '17') {
        return 'ORDER SET TO UPDATE SC';
    }
    else if (status == '18') {
        return 'ORDER SET TO BLM DEPO';
    }
    else if (status == '19') {
        return 'ORDER SET TO KENDALA SC';
    }
    else if (status == '20') {
        return 'ORDER SET TO DONE INSTALL AP';
    }
    else if (status == '21') {
        return 'ORDER SET TO KENDALA PROVISIONING WMS';
    }
    else if (status == '22') {
        return 'ORDER SET TO WAIT FCC';
    }
    else if (status == '23') {
        return 'ORDER SET TO KENDALA FCC';
    }
    else if (status == '24') {
        return 'ORDER SET TO PROGRESS FCC';
    }
    else if (status == '25') {
        return 'ORDER SET TO SCBE';
    }
    else if (status == '26') {
        return 'ORDER SET TO PROGRESS CONSTRUCTION PT2 SIMPLE';
    }
    else if (status == '27') {
        return 'ORDER SET TO PROGRESS CONSTRUCTION PT2 PLUS';
    }
    else if (status == '28') {
        return 'ORDER SET TO PROGRESS CONSTRUCTION PT3';
    }
    else if (status == '29') {
        return 'UPDATE LOCATION REAL';
    }
    else if (status == '30') {
        return 'UPDATE KETERANGAN KENDALA';
    }
    else if (status == '31') {
        return 'ORDER CONSTRUCTION SET TO MANJA ULANG';
    }
    else if (status == '32') {
        return 'ORDER CONSTRUCTION SET TO KENDALA PELANGGAN BATAL';
    }
    else if (status == '33') {
        return 'ORDER CONSTRUCTION SET TO KENDALA TERMINATE';
    }
    else if (status == '34') {
        return 'ORDER CONSTRUCTION APPROVED BY AMO';
    }
    else if (status == '35') {
        return 'ORDER CONSTRUCTION REJECTED BY AMO';
    }
    else if (status == '36') {
        return 'ORDER CONSTRUCTION SET TO REDESAIN';
    }
    else if (status == '37') {
        return 'ORDER CONSTRUCTION SELESAI DEPLOYMENT (VALIDASI GOLIVE)';
    }
    else if (status == '38') {
        return 'ORDER CONSTRUCTION SET TO KENDALA GOLIVE';
    }
    else if (status == '39') {
        return 'ORDER CONSTRUCTION SET TO PERBAIKAN MAINCORE';
    }
    else if (status == '40') {
        return 'ORDER CONSTRUCTION SET TO SELESAI GOLIVE';
    }
    else if (status == '41') {
        return 'ORDER CONSTRUCTION SET TO PROSES GOLIVE';
    }
    else if (status == '42') {
        return 'ORDER CONSTRUCTION REDESAIN PUSH TO APPROVAL AMO';
    }
    else if (status == '43') {
        return 'KENDALA SET TO TDK TER FOLLOW UP';
    }
    else if (status == '44') {
        return 'ORDER CONSTRUCTION APPROVED BY DATEL';
    }
    else if (status == '45') {
        return 'ORDER CONSTRUCTION REJECTED BY DATEL';
    }
}


function getstatusProjectLog(status)
{
    if (status == '1') {
        return 'CREATE PROJECT PT2 SIMPLE';
    }
    else if (status == '2') {
        return 'CREATE PROJECT NEXT PROJECT';
    }
    else if (status == '3') {
        return 'CREATE PROJECT PT2 PLUS';
    }
    else if (status == '4') {
        return 'PROJECT APPROVED BY AMO';
    }
    else if (status == '5') {
        return 'PROJECT REJECTED BY AMO';
    }
    else if (status == '6') {
        return 'PROJECT SET TO REDESAIN BY DEPLOYER';
    }
    else if (status == '7') {
        return 'PROJECT SET TO START PROJECT';
    }
    else if (status == '8') {
        return 'PROJECT SET TO SELESAI DEPLOYMENT (VALIDASI GOLIVE)';
    }
    else if (status == '9') {
        return 'PROJECT SET TO PERBAIKAN MAINCORE';
    }
    else if (status == '10') {
        return 'PROJECT SET TO KENDALA GOLIVE';
    }
    else if (status == '11') {
        return 'PROJECT SET TO SELESAI GOLIVE';
    }
    else if (status == '12') {
        return 'PROJECT SET TO PROSES GOLIVE';
    }
    else if (status == '13') {
        return 'PUSH PROJECT REDESAIN TO APPROVAL AMO ';
    }
    else if (status == '14') {
        return 'UPDATE KETERANGAN NEXT PROJECT';
    }
    else if (status == '15') {
        return 'PROJECT SET TO REDESAIN BY AMO';
    }
    else if (status == '16') {
        return 'PROJECT APPROVED BY DATEL';
    }
    else if (status == '17') {
        return 'PROJECT REJECTED BY DATEL';
    }
    else if (status == '18') {
        return 'PROJECT SET TO REDESAIN BY DATEL';
    }
}