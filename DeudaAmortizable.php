<?php
require_once 'Deuda.php';

class DeudaAmortizable extends Deuda {


    public function calcularCuota(): float {
        $interesMensual = ($this->tasaInteres / 100) / 12;
        $cuota = ($this->monto * $interesMensual) / 
                 (1 - pow(1 + $interesMensual, -$this->plazo));
        return $cuota;
    }


    public function generarTablaAmortizacion(): array {
        $tabla = [];
        $saldo = $this->monto;
        $cuota = $this->calcularCuota();
        $interesMensual = ($this->tasaInteres / 100) / 12;

        for ($mes = 1; $mes <= $this->plazo; $mes++) {
            $interes = $saldo * $interesMensual;
            $capital = $cuota - $interes;
            $saldo -= $capital;

            $tabla[] = [
                "mes" => $mes,
                "cuota" => round($cuota, 2),
                "interes" => round($interes, 2),
                "capital" => round($capital, 2),
                "saldo" => round(max($saldo, 0), 2)
            ];
        }

        return $tabla;
    }
}
