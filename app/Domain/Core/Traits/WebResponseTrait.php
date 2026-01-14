<?php

namespace Domain\Core\Traits;

use Exception;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

trait WebResponseTrait
{
    /**
     * function to return the success response
     * @param mixed $routeName
     * @param mixed $message
     * @param array $additionalData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successResponse($routeName, $message = "", array $additionalData = []): RedirectResponse
    {
        return redirect()->route($routeName, $additionalData)->with('message', $message);
    }

    /**
     * function to return the error response
     * @param \Exception $exception
     * @return RedirectResponse
     */
    public function errorResponse(Exception $exception)
    {
        return redirect()->back()->with('error', $exception->getMessage())->withInput();
    }

    /**
     * function to handle the ajax success response
     *
     * @param string $message
     * @param array $data
     * @param Response $code
     * @return mixed
     */
    public function successAjaxResponse(string $message, mixed $data = [], $code = Response::HTTP_OK)
    {
        $response = [];
        $response['status'] = 'success';
        if ($message) {
            $response['message'] = $message;
        }
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }

    /**
     * function to handle the ajax error response
     *
     * @param mixed $exception
     * @param Response $code
     * @param array $request
     * @return mixed
     */
    public function errorAjaxResponse($exception, array $request = [])
    {
        $code = 500;
        if ($exception instanceof \Throwable) {
            if ($exception->getMessage() === "The payload is invalid.") {
                $error = trans('auth.invalid');
                $code = 400;
            } else {
                $error = trans('app.internal_server_error');
            }
        } else {
            $error = $exception;
        }

        return response()->json(
            [
                'status'  => 'error',
                'message' => $error
            ],
            $code
        );
    }

    /**
     * function to handle the livewire response
     *
     * @param mixed $data
     * @param string $routeName
     * @param string $message
     * @return void
     */
    public function handleLivewireResponse(mixed $data, string $routeName = '', string $message = '')
    {
        if (!empty($data) || $data['success']) {
            session()->flash('success', $message);
            return redirect()->route($routeName);
        } else {
            session()->flash('error', 'Something went wrong!');
            return redirect()->back();
        }
    }
}
