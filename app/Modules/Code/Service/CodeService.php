<?php

namespace App\Modules\Code\Service;

use App\Modules\Code\Repository\CodeRepository;

class CodeService
{
    /** @var CodeRepository */
    private $codeRepository;

    public function __construct(CodeRepository $codeRepository)
    {
        $this->codeRepository = $codeRepository;
    }

    /**
     * @param array $params
     * @param int $id
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function update(array $params, int $id)
    {
        return $this->codeRepository->update($params, $id);
    }

    /**
     * @param string $code
     * @return bool
     */
    public function isCodeValid(string $code)
    {
        $code = $this->codeRepository->findByCodeName($code);

        if ($code != null && $code->user_id == null) {
            return true;
        }

        return false;
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function getIdByCode(string $code)
    {
        return $this->getIdByCode($code);
    }
}