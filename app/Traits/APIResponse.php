<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use JetBrains\PhpStorm\ArrayShape;

trait APIResponse
{

    /**
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    protected function sendEmptyResponse(int $code = 200): \Illuminate\Http\Response
    {
        return Response::make('', $code);
    }

    /**
     * Send response with success.
     *
     * @param  mixed|null  $result
     * @param  string|null  $message
     * @param  int  $code
     *
     * @return JsonResponse
     */
    protected function sendResponse(mixed $result = null, ?string $message = null, int $code = 200): JsonResponse
    {
        return response()
            ->json($this->makeResponse(true, $result, $message), $code)
            ->setPublic();
    }

    /**
     * Send response with error.
     *
     * @param  string  $error
     * @param  int  $code
     * @param  mixed|null  $data
     *
     * @return JsonResponse
     */
    protected function sendError(string $error, int $code = 400, mixed $data = null): JsonResponse
    {
        return response()
            ->json($this->makeResponse(false, $data, $error), $code)
            ->setPublic();
    }

    /**
     * Generate data array for response.
     *
     * @param  bool  $success
     * @param  mixed|null  $data
     *
     * @param  string|null  $message
     *
     * @return array
     */
    #[ArrayShape(['success' => "bool", 'message' => "string", 'data' => "array"])]
    protected function makeResponse(
        bool $success = true,
        mixed $data = null,
        ?string $message = null
    ): array {
        $result = [
            'success' => $success,
        ];
        if (null !== $data) {
            $result['data'] = $data;
        }
        if (null !== $message) {
            $result['message'] = $message;
        }

        return $result;
    }

}
