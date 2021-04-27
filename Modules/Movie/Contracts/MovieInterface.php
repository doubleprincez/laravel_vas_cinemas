<?php


namespace Modules\Movie\Contracts;



use Modules\Core\Contracts\CoreInterface;

interface MovieInterface extends CoreInterface
{

    public function getMovie($id,array $with = array());

}
