<?php

namespace App\Actions;

abstract class AbstractAction
{
    /**
     * Creates the action.
     *
     * @param array $parameters
     * @return self
     */
    public static function make(array $parameters = []): self
    {
        return app(static::class, $parameters);
    }

    /**
     * Executes the action.
     *
     * @return mixed
     */
    abstract public function execute();

    /**
     * Run the action.
     *
     * @param array $parameters
     * @return mixed
     */
    public static function run(array $parameters = [])
    {
        return static::make($parameters)->execute();
    }
}
