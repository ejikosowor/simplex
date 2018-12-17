<?php
// create_product.php <name>
require_once __DIR__.'/public/index.php';

use App\Models\Product;

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

$product = new Product();
$product->setName($faker->name);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";