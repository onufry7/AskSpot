<?php

use App\MovieRecommendation;
use PHPUnit\Framework\TestCase;

class MovieRecommendationTest extends TestCase
{
    public function testEmptyMoviesArray()
    {
        $movies = [];
        $recommendation = new MovieRecommendation($movies);

        $resultRandomRecommendations = $recommendation->getRandomRecommendations();
        $resultWRecommendations = $recommendation->getWRecommendations();
        $resultMultiWordRecommendations = $recommendation->getMultiWordRecommendations();

        $this->assertEmpty($resultRandomRecommendations);
        $this->assertEmpty($resultWRecommendations);
        $this->assertEmpty($resultMultiWordRecommendations);
    }


    public function testRandomRecommendations()
    {
        $movies = [
            "Movie1",
            "Movie2",
            "Movie3",
            "Movie4",
            "Movie5",
        ];
        $recommendation = new MovieRecommendation($movies);

        $result = $recommendation->getRandomRecommendations();

        $this->assertCount(3, $result);
        $this->assertContains($result[0], $movies);
        $this->assertContains($result[1], $movies);
        $this->assertContains($result[2], $movies);
    }


    public function testWRecommendations()
    {
        $movies = [
            "Wonder Woman",
            "The Dark Knight",
            "Wolverine",
            "Spider-Man",
            "Wall-E",
            "Władca Pierścieni: Dwie wieże",
        ];
        $recommendation = new MovieRecommendation($movies);

        $result = $recommendation->getWRecommendations();

        $this->assertCount(2, $result);
        $this->assertContains("Wonder Woman", $result);
        $this->assertContains("Wall-E", $result);
        $this->assertNotContains("The Dark Knight", $result);
        $this->assertNotContains("Wolverine", $result);
        $this->assertNotContains("Spider-Man", $result);
        $this->assertNotContains("Władca Pierścieni: Dwie wieże", $result);
    }


    public function testMultiWordRecommendations()
    {
        $movies = [
            "Inception",
            "The Dark Knight",
            "Forrest Gump",
            "The Matrix",
            "Interstellar",
            "Whiplash",
        ];
        $recommendation = new MovieRecommendation($movies);

        $result = $recommendation->getMultiWordRecommendations();

        $this->assertCount(3, $result);
        $this->assertContains("The Dark Knight", $result);
        $this->assertContains("Forrest Gump", $result);
        $this->assertContains("The Matrix", $result);
        $this->assertNotContains("Inception", $result);
        $this->assertNotContains("Interstellar", $result);
        $this->assertNotContains("Whiplash", $result);
    }
}
