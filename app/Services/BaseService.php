<?php
namespace App\Services;

abstract class BaseService
{
    protected function errValidate(string $message): ServiceResult
    {
        return $this->error(422, $message);
    }

    protected function errFobidden(string $message): ServiceResult
    {
        return $this->error(403, $message);
    }

    protected function errNotFound(string $message): ServiceResult
    {
        return $this->error(404, $message);
    }

    protected function errService(string $message): ServiceResult
    {
        return $this->error(500, $message);
    }

    protected function notAcceptable(string $message): ServiceResult
    {
        return $this->error(406, $message);
    }

    protected function ok(string $message = 'OK'): ServiceResult
    {
        return $this->result(['message' => $message]);
    }

    protected function result($data): ServiceResult
    {
        return new ServiceResult([
            'code' => 200,
            'data' => $data
        ]);
    }

    protected function error(int $code, string $message): ServiceResult
    {
        return new ServiceResult([
            'code' => $code,
            'data' => ['message' => $message]
        ]);
    }
}
