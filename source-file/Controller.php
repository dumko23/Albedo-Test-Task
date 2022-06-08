<?php

namespace App;

class Controller extends Model
{
    public function registerNewMember($data): bool|string
    {
        $result = $this->newMemberRecord($data);
        if($result === true){
            return true;
        } else{
            return $result;
        }
    }
}