<?php

function _anio($date = null) {
    return isset($date) ? date('Y', strtotime($date)) : $date;
}

function _mes($date = null)
{
    $mes=null;
    switch (date('M', strtotime($date))){
        case 'Jan': $mes="ENERO"; break;
        case 'Feb': $mes="FEBRERO"; break;
        case 'Mar': $mes="MARZO"; break;
        case 'Apr': $mes="ABRIL"; break;
        case 'May': $mes="MAYO"; break;
        case 'Jun': $mes="JUNIO"; break;
        case 'Jul': $mes="JULIO"; break;
        case 'Aug': $mes="AGOSTO"; break;
        case 'Sep': $mes="SEPTIEMBRE"; break;
        case 'Oct': $mes="OCTUBRE"; break;
        case 'Nov': $mes="NOVIEMBRE"; break;
        case 'Dec': $mes="DICIEMBRE"; break;
    }
    return $mes;
}
function _diaN($date = null) {
    $dia=null;
    switch (date('D', strtotime($date))){
        case 'Sun': $dia="DOMIGO"; break;
        case 'Mon': $dia="LUNES"; break;
        case 'Tue': $dia="MARTES"; break;
        case 'Wed': $dia="MIÉRCOLES"; break;
        case 'Thu': $dia="JUEVES"; break;
        case 'Fri': $dia="VIERNES"; break;
        case 'Sat': $dia="SÁBADO"; break;
    }
    return $dia;
}