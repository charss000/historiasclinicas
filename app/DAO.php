<?php

namespace App;

class DAO
{
    public function loadEloquent()
    {
        $this->db = new database();
    }
}
