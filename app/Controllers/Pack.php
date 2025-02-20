<?php

namespace App\Controllers;

use App\Models\Cards;
use App\Models\Packs;
use CodeIgniter\HTTP\RedirectResponse;

class Pack extends BaseController
{
    public function view(?int $pack_id = null): string
    {
        $cardsModel = new Cards();
        $data['pack_id'] = $pack_id;
        $data['cards'] = $cardsModel->where('pack_id', $pack_id)->findAll();
        return $this->template('cards', $data); 
    }

    public function create(): RedirectResponse
    {
        $data = $this->request->getPost();

        $fields = [
            'name' => $data['packName']
        ];
        $packsModel = new Packs();
        $packsModel->insert($fields);
        
        return redirect('/');
    }

    public function cardUpsert(): RedirectResponse
    {
        $data = $this->request->getPost();

        $fields = [
            'id' => $data['card_id'],
            'pack_id' => $data['pack_id'],
            'word' => $data['word'],
            'definition' => $data['definition'],
        ];
        $cardsModel = new Cards();
        $cardsModel->upsert($fields);
        
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}
