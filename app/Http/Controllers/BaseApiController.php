<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller {
	
	public function sendResponse($result, $message) {
		return response()->json([	
			'success' => true,
			'data' => $result,
			'message' => $message,
		], 200);
	}
	public function sendError($errors, $errorMessage, $code = 500) {
		return response()->json([
			'success' => false,
			'errors' => $errors,
			'message' => $errorMessage,
		], $code);
	}
}