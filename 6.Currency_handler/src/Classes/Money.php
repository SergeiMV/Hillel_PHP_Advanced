<?php

namespace HomeWorkSeven\Classes;

class Money
{

  private $amount;
  private $currency;

  public function __construct(int|float $amount, $currency)
  {
    $this->setAmount($amount);
    $this->setCurrency($currency);
  }

//setters
  
  private function setAmount($amount)
  {
    $this->amount = round($amount, 2);
  }

  private function setCurrency(Currency $currency)
  {
    $this->Currency = $currency;
  }

//getters
  
  public function getAmount()
  {
    return $this->amount;
  }

  public function getCurrency()
  {
    return $this->Currency;
  }

//equals

  public function equals(Money $second):bool
  {
    return $this == $second;
  }

//add
  
  public function add(Money $second)
  {
    if ($this->Currency == $second->Currency)
      $this->setAmount($this->getAmount() + $second->getAmount());
    else
      throw new Exception('Not equal currency');
  } 
}

