<?php

namespace App;

/**
 * Implements Battlesnake API response functions.
 *
 * @see https://docs.battlesnake.com/references/api
 */
class ApiController
{

    public static function handle($requestUri)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
        {
            return;
        }

        match($requestUri)
        {
            '/' => self::indexResponse(),
            '/start' => self::startResponse(),
            '/move' => self::moveResponse(),
            '/end' => self::endResponse(),
            default => self::notFound(),
        };
    }

    public static function indexResponse() : void
    {
        self::outputJsonResponse([
            'apiversion' => APIVERSION,
            'author' => AUTHOR,
            'color' => COLOR,
            'head' => HEAD,
            'tail' => TAIL,
        ]);
    }

    /**
     * Outputs a move response to the Battlesnake game engine.
     *
     * @param string $move Must be one of 'up', 'down', 'left', 'right', as per Battlesnake API
     *
     * @throws Exception
     */
    public static function moveResponse() : void
    {
        GameState::load( file_get_contents('php://input') );

        self::outputJsonResponse(['move' => GameState::you()->getMove()]);
    }

    /**
     * Responses to requests to the /start endpoint are ignored by the Battlesnake engine, so this function outputs nothing.
     *
     * @return void
     */
    public static function startResponse() : void
    {
        GameState::load( file_get_contents('php://input') );
    }


    /**
     * Responses to requests to the /end endpoint are ignored by the Battlesnake engine, so this function outputs nothing.
     *
     * @return void
     */
    public static function endResponse() : void
    {
        GameState::load( file_get_contents('php://input') );
    }


    /**
     * Outputs a 404 Not Found response.
     *
     * @return void
     */
    public static function notFound() : void
    {
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    }


    /**
     * Utility function to output an array of response data as JSON.
     *
     * @param array $responseData Array of data to be cast to an object and encoded to JSON
     */
    public static function outputJsonResponse(array $responseData) : void
    {
        $body = (object) $responseData;
        echo json_encode($body);
    }
}
