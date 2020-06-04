<?php

namespace App\Http\Controllers\Api;

use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller {

	public function getContent(Request $request, $content_id) {
		$content = Content::select('id', 'content_name', 'content_description', 'status')->find($content_id);
		if ($content) {
			$data['status'] = 'success';
			$data['content'] = $content;
		} else {
			$data['status'] = 'fail';
			$data['message'] = 'Content not found.';
		}
		return response()->json($data);
	}

	/**
	 *@SWG\Get(
	 *     path="/api/content/{contentid}",
	 *     summary="Get content by id",
	 *     operationId="content",
	 *     @SWG\Response(response=200, description="Successful operation")
	 * )
	 */

}
