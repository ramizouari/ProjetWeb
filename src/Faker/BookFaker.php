<?php
namespace App\Faker;
use Faker\Provider\Base;

class BookFaker extends Base
{
  public function title($nbWords = 5)
  {
    $sentence = $this->generator->sentence($nbWords);
    return substr($sentence, 0, strlen($sentence) - 1);
  }

  public function ISBN()
  {
    return $this->generator->ean13();
  }
}