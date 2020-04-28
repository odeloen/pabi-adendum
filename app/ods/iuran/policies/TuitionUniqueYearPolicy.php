<?php

namespace App\Ods\Iuran\Policies;

class TuitionUniqueYearPolicy
{
    private $tuitionRepository;

    public function __construct($tuitionRepository)
    {
        $this->tuitionRepository = $tuitionRepository;
    }

    public function isAllowed($tuition)
    {
        $activeTuitions = $this->tuitionRepository->all();

        foreach ($activeTuitions as $activeTuition) {
            if ($activeTuition->year == $tuition->year){
                return false;
            }
        }

        return true;
    }
}
