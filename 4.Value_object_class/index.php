<?php 
declare(strict_types=1);

class RGB
{

	private $red;
	private $green;
	private $blue;

	public function __construct(int $red, int $green, int $blue)
	{
		$this->setRed($red);
		$this->setGreen($green);
		$this->setBlue($blue);
	}

//setters
	
	private function setRed(int $red)
	{
		if ($red < 0 || $red > 255)
		{
			throw new Exception('Wrong value for red color');
		}
		$this->red = $red;
	}

	private function setGreen(int $green)
	{
		if ($green < 0 || $green > 255)
		{
			throw new Exception('Wrong value for green color');
		}
		$this->green = $green;
	}

	private function setBlue(int $blue)
	{
		if ($blue < 0 || $blue > 255)
		{
			throw new Exception('Wrong value for blue color');
		}
		$this->blue = $blue;
	}

//getters

	public function getRed()
	{
		return $this->red;
	}

	public function getGreen()
	{
		return $this->green;
	}

	public function getBlue()
	{
		return $this->blue;
	}

	public function getColors()
	{
		return ($this->red).", ".($this->green).", ".($this->blue);
	}

//equals

	public function equals(RGB $color2): bool
	{
		$redEq = ($this->getRed() == $color2->getRed());
		$greenEq = ($this->getGreen() == $color2->getGreen());
		$blueEq = ($this->getBlue() == $color2->getBlue());
		return ($redEq && $greenEq && $blueEq);
	}

//mix

	public function mix(RGB $color2): RGB
	{
		$redMix = intval(($this->getRed() + $color2->getRed())/2);
		$greenMix = intval(($this->getGreen() + $color2->getGreen())/2);
		$blueMix = intval(($this->getBlue() + $color2->getBlue())/2);
		return new RGB($redMix, $greenMix, $blueMix);
	}
}

$color = new RGB(256+rand(0,255),rand(0, 255), rand(0, 255));
$mixedColor = $color->mix(new RGB(rand(0, 255), rand(0, 255), rand(0, 255)));

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
</head>
<body style="background-color: RGB(<?= $mixedColor->getColors() ?>)">
  <?php if (!$color->equals($mixedColor)): ?>
    <p>Кольори не однаковi</p>
  <?php endif; ?>
  <pre>
    <?= var_dump($color).var_dump($mixedColor)?>
  </pre>
</body>
</html>
