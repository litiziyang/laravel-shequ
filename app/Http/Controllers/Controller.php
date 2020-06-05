<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 权限不足
     * @return BaseResource
     */
    public function permission()
    {
        return new BaseResource('400', '您没有权限');
    }

    /**
     * 成功后返回
     * @param mixed|null $data
     *
     * @return BaseResource
     */
    public function success($data = null)
    {
        return new BaseResource(0, '', $data);
    }

    /**
     * 验证失败返回
     * @param mixed|null $data
     *
     * @return  BaseResource
     */
    public function validate($data = null)
    {
        return new BaseResource(400, '参数错误', $data);
    }

    /**
     * 操作失败后返回
     * @param mixed|null $data
     * @param string     $msg
     *
     * @return BaseResource
     */
    public function failed($msg = '操作失败', $data = null)
    {
        return new BaseResource('500', $msg, $data);
    }

}
