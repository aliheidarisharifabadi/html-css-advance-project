<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use PoolPort\Exceptions\InvalidRequestException;
use PoolPort\Exceptions\NotFoundTransactionException;
use PoolPort\Exceptions\PortNotFoundException;
use PoolPort\Exceptions\RetryException;
use PoolPort\Pay\PaySendException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * @param  \Exception $exception
	 * @return void
	 * @throws Exception
	 */
	public function report(Exception $exception)
	{
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception               $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception)
	{
		if ($request->is("api/*")) {
			$status = 200;
		}

		if ($request->isJson() || $request->is("api/*")) {

			if ($exception instanceof ValidationException) {
				$errors = [];

				if ($request->is("api/*")) {
					foreach ($exception->validator->getMessageBag()->getMessages() as $name => $error) {
						$errors[] = $error[0];
					}
				} else {
					foreach ($exception->validator->getMessageBag()->getMessages() as $name => $error) {
						$errors[] = [
							'name'  => $name,
							'error' => $error[0],
						];
					}
				}

				return response([
					'success' => false,
					'message' => trans('validation.message'),
					'errors'  => array_values($errors),
				], $status ?? 422);
			}

		}

		if (config('app.debug')) {
			\Log::info(parent::render($request, $exception));
		}

		if ($request->isJson() || $request->is("api/*")) {

			if ($exception instanceof ThrottleRequestsException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.too_many_request'),
				], $status ?? 429)->withHeaders($exception->getHeaders());
			}

			if ($exception instanceof ModelNotFoundException) {
				// ajax 404 json feedback
				return response([
					'success' => false,
					'message' => trans('messages.exception.model_not_found', [
						'model' => trans('models.' . $exception->getModel()),
					]),
				], $status ?? 404);
			}

			if ($exception instanceof NotFoundHttpException) {
				// ajax 404 json feedback
				return response([
					'success' => false,
					'message' => trans('messages.exception.not_found'),
				], $status ?? 404);
			}

			if ($exception instanceof UnauthorizedException) {
				return response([
					'error'   => 1002,
					'success' => false,
					'message' => trans('messages.exception.not_access'),
				], $status ?? 403);
			}

			if ($exception instanceof AuthorizationException) {
				return response([
					'error'   => 1002,
					'success' => false,
					'message' => trans('messages.exception.not_access'),
				], $status ?? 403);
			}

			if ($exception instanceof AuthenticationException) {
				return response([
					'error'   => 1001,
					'success' => false,
					'message' => trans('messages.exception.not_auth'),
				], $status ?? 401);
			}

			if ($exception instanceof AccessDeniedHttpException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.access_deny'),
				], $status ?? 403);
			}

			if ($exception instanceof MethodNotAllowedHttpException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.method_not_allow'),
				], $status ?? 405);
			}

			// payment exception

			if ($exception instanceof InvalidRequestException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.invalid_request'),
				], $status ?? 403);
			}

			if ($exception instanceof NotFoundTransactionException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.not_found_transaction'),
				], $status ?? 403);
			}

			if ($exception instanceof PortNotFoundException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.port_not_found'),
				], $status ?? 403);
			}

			if ($exception instanceof RetryException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.invalid_request'),
				], $status ?? 403);
			}

			if ($exception instanceof PaySendException) {
				return response([
					'success' => false,
					'message' => trans('messages.exception.pay_send_exception'),
				], $status ?? 403);
			}

		}

		if ($request->isJson()) {
			return response([
				'success' => false,
				'message' => $exception->getMessage(),
			], $status ?? 403);
		}

		return parent::render($request, $exception);
	}
}
