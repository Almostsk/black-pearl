<?php

namespace App\Modules\Code\Repository;

use App\Models\Code;
use App\Modules\Core\BaseRepository;

class CodeRepository extends BaseRepository
{
    public function __construct(Code $code)
    {
        parent::__construct($code);
    }

    public function findByCodeName(string $codeName)
    {
        return $this->model->where('code_name', $codeName)->first();
    }

    public function update(array $params, int $id)
    {
        $this->model->find($id)->update($params);
    }

    public function getIdByCode(string $codeName)
    {
        return $this->findByCodeName($codeName)->id;
    }
}