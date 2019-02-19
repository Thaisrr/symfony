<?php
/**
 * Created by PhpStorm.
 * User: dawan
 * Date: 08/02/2019
 * Time: 14:53
 */

namespace App\Service;


class Unique
{
    private $message = "Hello je suis un service ! ;) ";

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }


}