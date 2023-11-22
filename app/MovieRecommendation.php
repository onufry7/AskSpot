<?php

namespace App;


class MovieRecommendation
{
    private $movies;



    public function __construct(array $movies)
    {
        $this->movies = $movies;
    }


    public function getRandomRecommendations(): int|array|string
    {
        return empty($this->movies) ? [] : array_rand(array_flip($this->movies), 3);
    }


    public function getWRecommendations(): array
    {
        return array_filter($this->movies, function ($title) {
            return strtoupper(mb_substr($title, 0, 1)) === 'W' && mb_strlen($title) % 2 === 0;
        });
    }


    public function getMultiWordRecommendations(): array
    {
        return array_filter($this->movies, function ($title) {
            return count(explode(' ', $title)) > 1;
        });
    }
}
