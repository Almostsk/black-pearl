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

    /**
     * @param string $codeName
     * @return mixed
     */
    public function findByCodeName(string $codeName)
    {
        return $this->model->where('code_name', $codeName)->first();
    }

    /**
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function update(array $params, int $id)
    {
        return $this->model->find($id)->update($params);
    }

    /**
     * @param string $codeName
     * @return mixed
     */
    public function getIdByCode(string $codeName)
    {
        $code = $this->findByCodeName($codeName);

        return $code ? $code->id : null;
    }
}