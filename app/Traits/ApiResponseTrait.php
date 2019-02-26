<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Return json response for Rest API
     *
     * @param string $message
     * @param null $data
     * @param bool $isSuccess
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse(string $message = '', $data = null, bool $isSuccess = true, $code = 200)
    {
        return response()->json([
            'success'   => $isSuccess,
            'message'   => $message,
            'data'      => $data,
            'code'      => $code
        ], $code);
    }

    /**
     * Return xml response for Rest API
     * 
     * @param array $responseBody
     * @return \Illuminate\Http\Response
     */
    protected function sendXmlResponse(array $responseBody)
    {
        return response()
                ->view('xml.response', $responseBody)
                ->header('Content-Type', 'text/xml');
    }
}
