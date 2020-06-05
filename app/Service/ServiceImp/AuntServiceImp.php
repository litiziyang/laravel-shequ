<?php


namespace App\Service\ServiceImp;


use App\aunt;
use App\Service\AuntService;

class AuntServiceImp implements AuntService
{
    protected $aunt;

    public function __construct(aunt $aunt)
    {
        $this->aunt = $aunt->query();
    }

    /**
     * 打卡
     *
     */
    public function sign($type, $user_id, $datetime)
    {
        $this->aunt->firstOrCreate([
            'type' => $type,
            'user_id' => $user_id,
            'datetimes' => $datetime
        ]);
        return '打卡成功';

    }
}
