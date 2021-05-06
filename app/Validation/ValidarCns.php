<?php

namespace App\Validation;

class ValidarCns
{
	public function ValidarCns($cns,string &$error = null) : bool{
        $pis = substr($cns,0,11);
        $soma = 0;
        for ( $i = 0, $j = strlen($pis), $k = 15; $i < $j; $i++, $k-- )
        {
            $soma += $pis[$i] * $k;
        }
        $dv = 11 - fmod($soma, 11);
        $dv = ($dv != 11) ? $dv : '0'; // retorna '0' se for igual a 11
        if ( $dv == 10 )
        {
            $soma += 2;
            $dv = 11 - fmod($soma, 11);
            $resultado = $pis.'001'.$dv;
        }
        else
        {
            $resultado = $pis.'000'.$dv;
        }
        if ( $cns != $resultado )
        {
			$error = lang('Validation.ValidarCns');
            return false;
        }
        else
        {
            return true;
        }
	}
}
