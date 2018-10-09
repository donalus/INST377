<?php
class Doggo {
  public $name;
  public $breed;
	protected $hasFur;
	function __constructor() {
		$this->hasFur = true;
	}

	final function bork() {
		echo 'bork bork';
	}
}

class Pupper extends Doggo {
	private $isSmol;

	function __constructor() {
		parent::__constructor();
		$this->isSmol = true;
	}

  function isSmol(){
    return $this->isSmol;
  }
}
echo 'Create new instance';
$dog = new Doggo();
$dog->breed = 'Mut';
$pup = new Pupper();
echo $pup->isSmol();
?>
