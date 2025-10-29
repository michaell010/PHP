<?php
class Deuda {
    protected float $monto;
    protected float $tasaInteres;
    protected int $plazo;

    public function __construct(float $monto = 0, float $tasaInteres = 0, int $plazo = 0) {
        $this->monto = $monto;
        $this->tasaInteres = $tasaInteres;
        $this->plazo = $plazo;
    }

    public function setMonto(float $monto) { $this->monto = $monto; }
    public function setTasaInteres(float $tasaInteres) { $this->tasaInteres = $tasaInteres; }
    public function setPlazo(int $plazo) { $this->plazo = $plazo; }

    public function getMonto(): float { return $this->monto; }
    public function getTasaInteres(): float { return $this->tasaInteres; }
    public function getPlazo(): int { return $this->plazo; }


    public function calcularCuota(): float {
        return 0.0;
    }
}
