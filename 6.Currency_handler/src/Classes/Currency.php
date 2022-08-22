<?php 

namespace HomeWorkSeven\Classes;

class Currency
{
  private string $isoCode;

  public function __construct(string $code)
  {
    $this->setCode($code);
  }

//setters

  private function setCode($code)
  {
    $chr_en="A-Z\s";
    if ((is_string($code)) && (mb_strlen($code) == 3) && (preg_match("/^[$chr_en]+$/", $code)))
      $this->isoCode=$code;
    else
      throw new Exception('Wrong currency code');
  }

//getters

  public function getCode()
  {
    return $this->isoCode;
  }

//equals

  public function equals(Currency $secondCode):bool
  {
    return $this == $secondCode;
  }
}
