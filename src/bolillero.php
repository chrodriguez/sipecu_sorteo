<?php
namespace Cespi\SipecuBundle\Util;

class Bolillero {
  public $max = 0;
  function __construct () {
  }

  function generarNumerosHasta($num) {
    $this->max = $num;
    $this->positions = array();
    for ($i=1; $i <= $num; $i++) $this->positions[$i] = $i;
  }


  function sortear() {
    for ($i = $this->max; $i > 1; $i--)
    {
      $rand = mt_rand(1,$i);
      $this->swap($i,$rand);
    }
    return $this->positions;
  }

  function __toString() {
    return join(',', array_values($this->positions));
  }

  private function swap($old, $new) {
    $aux = $this->positions[$old];
    $this->positions[$old] = $this->positions[$new];
    $this->positions[$new] = $aux;
  }


}
