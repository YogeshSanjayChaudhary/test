<?php

namespace App\Http\Controllers\Api;

use App\Classes;
use App\Content;
use App\ContentClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassesController extends Controller {
	public function getClasses(Request $request) {
		$classes = Classes::select('id', 'class_name', 'description', 'status')->where('status', 'active')->orderby('class_name', 'asc')->get();
		if ($classes) {
			$data['status'] = 'success';
			$data['classes'] = $classes;
		} else {
			$data['status'] = 'fail';
			$data['message'] = 'Classes not found.';
		}
		return response()->json($data);
	}

	/**
	 * @SWG\Swagger(
	 *     @SWG\Info(
	 *         version="1.0.0",
	 *         title="Edu API",
	 *         description="All API",
	 *         @SWG\Contact(
	 *             email="sagarprajapati680@gmail.com"
	 *         ),
	 *     ),@SWG\Get(
	 *          path="/api/classes",
	 *          summary="Get all class",
	 *          operationId="classes",
	 *          @SWG\Response(response=200, description="Successful operation")
	 *      )
	 * )
	 */

	public function getClassContent(Request $request, $class_id) {
		$class = Classes::select('id', 'class_name', 'description', 'status')->find($class_id);
		$class_content = ContentClass::where('class_id', $class_id)->get();
		if ($class) {

			$content = array();
			foreach ($class_content as $key => $cc) {
				$content[] = Content::select('id', 'content_name', 'content_description', 'status')->where('status', 'active')->find($cc->content_id);
			}
			$data['status'] = 'success';
			$data['class'] = $class;
			$data['content'] = $content;
		} else {
			$data['status'] = 'fail';
			$data['message'] = 'Class not found.';
		}
		return response()->json($data);
	}

	/**
	 *@SWG\Get(
	 *     path="/api/class-content/{classid}",
	 *     summary="Get class all content",
	 *     operationId="class_all_content",
	 *     @SWG\Response(response=200, description="Successful operation")
	 * )
	 */

}
