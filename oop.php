<?php

abstract class Airplane {
    private bool $isFlying;
    public string $name;
    public int $maxSpeed;

    public function __construct(string $name, int $maxSpeed)
    {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
    }

    public function takeoff()
    {
        $this->isFlying = true;
    }

    public function land()
    {
        $this->isFlying = false;
    }


    public function isFlying(): bool
    {
        return $this->isFlying;
    }
}

class Mig extends Airplane {}

class Tu154 extends Airplane {

    public function attack(): string
    {
        return 'attack';
    }
}

class Airport {
    private ?Airplane $airplane;
    public bool $isParkingBusy;
    public bool $isGasStationBusy;
    public bool $isMaintenance;

    public function takePlane(Airplane $airplane): bool
    {
        if ($this->airplane || $this->isMaintenance) {
           return false;
        }

        $this->airplane = $airplane;
        $this->airplane->land();

        return true;
    }

    public function sendPlane()
    {
        $this->airplane->takeoff();
        $this->airplane = null;
    }

    public function planeIsReady()
    {
        $this->isParkingBusy = false;
        $this->isGasStationBusy = false;
    }

    public function parkPlane()
    {
        $this->isParkingBusy = true;
    }

    public function refuelPlane()
    {
        $this->isGasStationBusy = true;
    }

    public function setMaintenance(bool $status)
    {
        $this->isMaintenance = $status;
    }
}