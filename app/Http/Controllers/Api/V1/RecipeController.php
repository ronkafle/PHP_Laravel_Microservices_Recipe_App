<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Models\Recipe\Recipe AS RecipeModel;
use App\Http\Resources\Recipe AS RecipeResource;
use App\Models\Recipe\Recipe;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 */
class RecipeController extends ApiController
{
	/**
	 * Display a list of all recipes
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function getAll(Request $request)
	{
		return RecipeResource::collection(RecipeModel::all());
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 *
	 * @return \App\Http\Resources\Recipe
	 */
	public function show(Recipe $recipe)
	{
		return new RecipeResource($recipe);
	}

	/**
	 * @param Recipe                   $recipe
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \App\Http\Resources\Recipe|\Illuminate\Http\JsonResponse
	 */
	public function update(Recipe $recipe, Request $request)
	{
		$validator = \Validator::make($request->all(), ['title'       => 'string|required',
														'description' => 'string|required']);

		if ($validator->fails()) {
			return $this->returnValidationErrors($validator);
		}

		return new RecipeResource($recipe);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \App\Http\Resources\Recipe|\Illuminate\Http\JsonResponse
	 */
	public function store(Request $request)
	{
		/* @var \App\User $user */
		$user = \Auth::user();

		$requestData = $request->all();

		$validator = \Validator::make($requestData, ['title'       => 'string|required',
													 'description' => 'string|required']);

		if ($validator->fails()) {
			return $this->returnValidationErrors($validator);
		}

		$recipe = RecipeModel::create(['title'       => $requestData['title'],
									   'description' => $requestData['description'],
									   'image_path'  => 'img/default.jpg',
									   'user_id'     => $user->id]);

		return new RecipeResource($recipe);
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function delete(Recipe $recipe)
	{
		$recipe->delete();

		return $this->returnSuccess('Recipe deleted successfully');
	}
}
