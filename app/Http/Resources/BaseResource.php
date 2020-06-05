<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected $msg;
    protected $data;
    protected $code;

    public function __construct($code, $msg, $data = null)
    {

        parent::__construct($this->resource);
        $this->code = $code;
        $this->msg = $msg;
        $this->data = $data;
    }

    public function toArray($request)
    {
        return [
            'msg' => $this->msg,
            'code' => $this->code,
            'data' => $this->data
        ];
    }
}
