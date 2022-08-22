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
			throw new Exception('Wrong value for blue color'.$blue);
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

$color = new RGB(rand(0,255),rand(0, 255), rand(0, 255));
$mixedColor = $color->mix(new RGB(rand(0, 255), rand(0, 255), rand(0, 255)));

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
</head>
<body>
  <?php  $z=0; $y=0; $a=0 ?>
<table>
<body>
<tr>
<td>
<table>
<body>
  <?php for ($x=0;$x<132;$x+=5): ?> 
    <tr>
     <?php for ($y=0;$y<132;$y+=5): ?>
       	 <?php $color = new RGB($x,$z, $y); ?>
	  <td style="background-color: RGB(<?= $color->getColors(); ?>)">
	   <?= "1R".$x."-"."G".$z."-"."B".$y; ?> </td>
         <?php endfor; ?>
     </tr>
   <?php endfor; ?>
</body>
</table>
</td>
<td>

<table>
<body>
  <?php for ($x=0, $z=0;$x<132;$x+=5, $z+=5): ?> 
    <tr>
     <?php for ($y=132;$y<255;$y+=5): ?>
       	 <?php $color = new RGB($x, intval(abs($z-$y)), $y); ?>
	  <td style="background-color: RGB(<?= $color->getColors(); ?>)">
	   <?= "1R".$x."-"."G".intval(abs($z-$y))."-"."B".$y; ?> </td>
         <?php endfor; ?>
     </tr>
   <?php endfor; ?>
</body>
</table>
</td>
</tr>
<tr>
<td>
<table>
<body>
  <?php for ($x=0;$x<132;$x+=5): ?> 
    <tr>
     <?php for ($y=0;$y<132;$y+=5): ?>
       	 <?php $color = new RGB($x, $y, intval(abs(($y-$x)))); ?>
	  <td style="background-color: RGB(<?= $color->getColors(); ?>)">
	   <?= "1R".$x."-"."G".$y."-"."B".intval(abs(($y-$x))); ?> </td>
         <?php endfor; ?>
     </tr>
   <?php endfor; ?>
</body>
</table>
</td>
<td>
<table>
<body>
  <?php for ($x=0;$x<132;$x+=5): ?> 
    <tr>
     <?php for ($y=132;$y<255;$y+=5): ?>
       	 <?php $color = new RGB($x, $y, intval(abs(($y-$x)))); ?>
	  <td style="background-color: RGB(<?= $color->getColors(); ?>)">
	   <?= "2R".$x."-"."G".$y."-"."B".intval(abs(($y-$x))); ?> </td>
         <?php endfor; ?>
     </tr>
   <?php endfor; ?>
</body>
</table>
</td>
</tr>
<tr>
<tr>
<td>
<table>
<body>
  <?php for ($x=132;$x<256;$x+=5): ?> 
    <tr>
     <?php for ($y=0;$y<132;$y+=5): ?>
       	 <?php $color = new RGB($x, $y, intval(abs(($x-$y)))); ?>
	  <td style="background-color: RGB(<?= $color->getColors(); ?>)">
	   <?= "3R".$x."-"."G".$y."-"."B".intval(abs(($x-$y))); ?> </td>
         <?php endfor; ?>
     </tr>
   <?php endfor; ?>
</body>
</table>
</td>
<td>
<table>
<body>
  <?php for ($x=132;$x<256;$x+=5): ?> 
    <tr>
     <?php for ($y=132, $z=132;$y<255;$y+=5, $z-=5): ?>
       	 <?php $color = new RGB($x, $y, intval(abs(($x-$z)))); ?>
	  <td style="background-color: RGB(<?= $color->getColors(); ?>)">
	   <?= "4R".$x."-"."G".$y."-"."B".intval(abs(($x-$z))); ?> </td>
         <?php endfor; ?>
     </tr>
   <?php endfor; ?>
</body>
</table>
</td>
</tr>
</body>
</table>
</body>
</html>
