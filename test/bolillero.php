<?php

class BolilleroTest extends PHPUnit_Framework_TestCase {

    private function factorial($n) {
      $ret = 1;
      for($i=1; $i <= $n; $i++, $ret *= $i);
      return $ret;
    }

    private function crearBolillero($n) {
      $b = new Cespi\SipecuBundle\Util\Bolillero();
      $b->generarNumerosHasta($n);
      $b->sortear();
      return $b;
    }

    private function combinacionesPosibles($n) {
      $items = array();
      for ($i = 1; $i <= $n; $i++) $items[] = $i;
      $this->pc_permute($items, array(), $combinaciones);
      return $combinaciones;
    }

    // Permutaciones extraidas de O'Reily
    private function pc_permute($items, $perms = array( ), & $result = array()) {
      if (empty($items)) {
        $result[] = join(',', $perms);
      }  else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
          $newitems = $items;
          $newperms = $perms;
          list($foo) = array_splice($newitems, $i, 1);
          array_unshift($newperms, $foo);
          $this->pc_permute($newitems, $newperms, $result );
        }
      }
    }

    public function generalTestBolillero($n, $lanzamientos) {
      $resultados = array();
      foreach ($this->combinacionesPosibles($n) as $c) $resultados[$c] = 0;
      $combinaciones = $this->factorial($n);
      $media = $lanzamientos / $combinaciones;
      for( $i = 0; $i < $lanzamientos; $i++) {
        $resultados[$this->crearBolillero($n)->__toString()]++;
      }
      echo "\nResultados para $n elementos y $lanzamientos lanzamientos (media esperada $media)\n\n";
      foreach($resultados as $k => $v) {
        echo "$k => $v\n";
//        $this->assertLessThanOrEqual(1,abs($media - $v), "Cantidad desviada para $k");
      }
    }

    public function testBolillero_3_1000000() {
      $this->generalTestBolillero(3,1000000);
    }

    public function testBolillero_3_100000() {
      $this->generalTestBolillero(3,100000);
    }

    public function testBolillero_3_10000() {
      $this->generalTestBolillero(3,10000);
    }

    public function testBolillero_6_10000() {
      $this->generalTestBolillero(6,10000);
    }

    public function testBolillero_6_100000() {
      $this->generalTestBolillero(6,100000);
    }
}

