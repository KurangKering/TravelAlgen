<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class City {

    public $x;
    public $y;
    public $kode;
    public $jarakKe;
    public function __construct($x = '', $y = '', $kode = "", $jarakKe)
    {
        $this->x = $x;
        $this->y = $y;
        $this->kode = $kode;
        $this->jarakKe = $jarakKe;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }


    public function distanceTo(City $city) {


        // $xDistance = abs($this->getX() - $city->getX());
        // $yDistance = abs($this->getY() - $city->getY());

        // $distance = sqrt( ($xDistance*$xDistance) + ($yDistance*$yDistance) );
        
      $distance =  $this->jarakKe[$city->kode];
     

        return $distance;
    }

    public function __toString()
    {
        return $this->kode;
        // return $this->getX() . ', '  . $this->getY();
    }


}