<?php

namespace App\Util;

use App\Entity\Tax;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class TaxCalculator
{
  private Product $product;
  public function __construct(
    private EntityManagerInterface $entityManager
  ) {
  }

  public function setProduct(Product $product) {
    $this->product = $product;
  }

  public function calc(string $code): int|float { 
    $price = $this->product->getPrice();
    $countryCode = $this->getCountryCode($code);
    $tax = $this->entityManager->getRepository(Tax::class)->findOneBy(['code' => $countryCode]);
    $calcTax = 0;
    if ($tax) {
      $calcTax = ($price * $tax->getTax()) / 100;
    }
    return $calcTax;
  }

  private function getCountryCode($code) {
    $countryCode = substr($code, 0, 2);
    return strtoupper($countryCode);
  }
}