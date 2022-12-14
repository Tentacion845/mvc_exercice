<?php

/**
 * Created by PhpStorm.
 * User: criquier
 * Date: 23/10/15
 * Time: 09:36
 */

class Controller
{
    protected $dataBase;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }
}
