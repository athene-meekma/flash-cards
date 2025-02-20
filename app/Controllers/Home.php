<?php

namespace App\Controllers;
use App\Models\Packs;

class Home extends BaseController
{
    public function index(): string
    {
        $packsModel = new Packs();
        $data['packs'] = $packsModel->getPacks();

        return $this->template('packs', $data);
    }
}
