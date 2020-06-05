<?php


namespace App\graphql;


use App\Http\Resources\BaseController;
use App\Http\Resources\BaseResource;

class Controller extends BaseController
{
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
