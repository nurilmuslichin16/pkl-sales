<?php

$GLOBALS['administrator']  = 0; // Administrator
$GLOBALS['cs']             = 1; // Sales
$GLOBALS['backroom']       = 2; // TL and HD
$GLOBALS['deployment']     = 3; // Pembangunan / SDI
$GLOBALS['guest']          = 4; // Tamu
$GLOBALS['manajemen']      = 5; // Manajemen

/* ------------------------ */
/* -------- MENU ---------- */
/* ------------------------ */

function menuDashboardTeknisi($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuProduktifitasPsb($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuMonitoringBA($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuProgressProvi($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuUpload($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuRequestSc($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function subMenuInputSCPlasa($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuConstruction($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuUnscEngagement($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuReport($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuMitra($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function menuTeknisi($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

/* ------------------------ */
/* -------- CRUD ---------- */
/* ------------------------ */

function cannotDelete($level)
{
    if ($level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

/* -------- Dashboard PSB, Teknisi & Progres Provi ---------- */
function aksesOrderDashboardPSB($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['guest'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function aksesOrderDealFCC($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['guest'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function aksesOrderRequestSCKendalaProvi($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateOrderFCC($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateOrderAmunisi($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateOrderProvi($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateViaSearch($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}
/* ---------------------------------------------------------- */

/* -------- Kendala & Project ---------- */
function updateKendala($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateKendalaFull($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['backroom'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function createProject($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function manjaUlangConstruction($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateProject($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}

function updateProjectApprovalDatel($level)
{
    if ($level == $GLOBALS['administrator'] || $level == $GLOBALS['cs'] || $level == $GLOBALS['deployment'] || $level == $GLOBALS['manajemen']) {
        return true;
    } else {
        return false;
    }
}
/* ---------------------------------------------------------- */