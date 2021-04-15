<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class ApiController extends Controller
{
	/**
	 * @param        $errorMessage
	 * @param        $status
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function returnError($errorMessage, $status = Response::HTTP_BAD_REQUEST)
	{
		$errors = ['status'            => $status,
				   'error_message'     => $errorMessage,
				   'validation_errors' => null];

		return response()->json($errors, $status, [], JSON_PRETTY_PRINT);
	}

	/**
	 * @param Validator $validator
	 * @param string    $errorMessage
	 * @param int       $status
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */

	protected function returnValidationErrors(Validator $validator, $errorMessage = 'Invalid inputs', $status = Response::HTTP_BAD_REQUEST)
	{
		$errors = ['status'            => $status,
				   'error_message'     => $errorMessage,
				   'validation_errors' => $validator->errors()];

		return response()->json($errors, $status, [], JSON_PRETTY_PRINT);
	}

	/**
	 * @param $successMessage
	 * @param $status
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */

	protected function returnSuccess($successMessage, $status = Response::HTTP_OK)
	{
		$errors = ['success_message' => $successMessage];

		return response()->json($errors, $status, [], JSON_PRETTY_PRINT);
	}
}
