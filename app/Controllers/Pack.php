<?php

namespace App\Controllers;

use App\Models\Cards;
use App\Models\Packs;
use CodeIgniter\HTTP\RedirectResponse;

class Pack extends BaseController
{
    public function view(?int $pack_id = null): string
    {
        $data['pack']  = (new Packs())->find($pack_id);
        $data['cards'] = (new Cards())->where('pack_id', $pack_id)->findAll();
        return $this->template('cards', $data);
    }

    public function packUpsert(): RedirectResponse
    {
        $data = $this->request->getPost();

        $fields = [
            'id'   => $data['pack_id'],
            'name' => $data['packName']
        ];
        $packsModel = new Packs();
        $packsModel->upsert($fields);

        return redirect('/');
    }

    public function packDelete(): RedirectResponse
    {
        $data = $this->request->getPost();

        $packsModel = new Packs();
        $packsModel->delete($data['pack_id']);

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
            'sound_clip' => $data['sound_clip'],
        ];
        $cardsModel = new Cards();
        $cardsModel->upsert($fields);

        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function cardDelete(): RedirectResponse
    {
        $data = $this->request->getPost();

        $card = new Cards();
        $card->delete($data['card_id']);

        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}
