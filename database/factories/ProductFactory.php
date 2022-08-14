<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images= [
            "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg",
            "https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg",
            "https://fakestoreapi.com/img/71li-ujtlUL._AC_UX679_.jpg",
            "https://fakestoreapi.com/img/71YXzeOuslL._AC_UY879_.jpg",
            "https://fakestoreapi.com/img/71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg",
            "https://fakestoreapi.com/img/61sbMiUnoGL._AC_UL640_QL65_ML3_.jpg",
            "https://fakestoreapi.com/img/71YAIFU48IL._AC_UL640_QL65_ML3_.jpg",
            "https://fakestoreapi.com/img/51UDEzMJVpL._AC_UL640_QL65_ML3_.jpg",
            "https://fakestoreapi.com/img/61IBBVJvSDL._AC_SY879_.jpg",
            "https://fakestoreapi.com/img/61U7T1koQqL._AC_SX679_.jpg",
            "https://fakestoreapi.com/img/71kWymZ+c+L._AC_SX679_.jpg",
            "https://fakestoreapi.com/img/61mtL65D4cL._AC_SX679_.jpg",
            "https://fakestoreapi.com/img/81QpkIctqPL._AC_SX679_.jpg",
            "https://fakestoreapi.com/img/81Zt42ioCgL._AC_SX679_.jpg",
            "https://fakestoreapi.com/img/51Y5NI-I5jL._AC_UX679_.jpg",
            "https://fakestoreapi.com/img/81XH0e8fefL._AC_UY879_.jpg",
            "https://fakestoreapi.com/img/71HblAHs5xL._AC_UY879_-2.jpg",
            "https://fakestoreapi.com/img/71z3kpMAYsL._AC_UY879_.jpg",
            "https://fakestoreapi.com/img/51eg55uWmdL._AC_UX679_.jpg",
            "https://fakestoreapi.com/img/61pHAEJ4NML._AC_UX679_.jpg"
        ];

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'qty' => $this->faker->numberBetween(10, 2000),
            'image' => $images[rand(0,19)],
        ];
    }
}
