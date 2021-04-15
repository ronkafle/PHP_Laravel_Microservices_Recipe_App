<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\RecipeIngredient;
use App\Models\Recipe\Ingredient;
use App\Models\Recipe\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @package App\Http\Controllers
 */
class IngredientController extends ApiController
{
	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function getAll(Recipe $recipe)
	{
		return RecipeIngredient::collection($recipe->ingredients);
	}

	/**
	 * @param Recipe     $recipe
	 * @param Ingredient $ingredient
	 *
	 * @return \App\Http\Resources\RecipeIngredient|\Illuminate\Http\JsonResponse
	 */
	public function show(Recipe $recipe, Ingredient $ingredient)
	{
		if ($recipe->id != $ingredient->recipe_id) {
			return $this->returnError('Recipe-Ingredient relationship not matching');
		}

		return new RecipeIngredient($ingredient);
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 * @param \Illuminate\Http\Request  $request
	 *
	 * @return \App\Http\Resources\RecipeIngredient
	 */
	public function store(Recipe $recipe, Request $request)
	{
		$validatedData = $request->validate(['name'     => 'required|string',
											 'quantity' => 'required|string']);

		$ingredient = Ingredient::create(['name'      => $validatedData['name'],
										  'quantity'  => $validatedData['quantity'],
										  'recipe_id' => $recipe->id]);

		return new RecipeIngredient($ingredient);
	}

	/**
	 * @param \App\Models\Recipe\Recipe     $recipe
	 * @param \App\Models\Recipe\Ingredient $ingredient
	 * @param \Illuminate\Http\Request      $request
	 *
	 * @return \App\Http\Resources\RecipeIngredient|\Illuminate\Http\JsonResponse
	 */
	public function update(Recipe $recipe, Ingredient $ingredient, Request $request)
	{
		if ($recipe->id != $ingredient->recipe_id) {
			return $this->returnError('Recipe-Ingredient relationship not matching');
		}

		$validator = \Validator::make($request->all(), ['name'     => 'string|required',
														'quantity' => 'string|required']);

		if ($validator->fails()) {
			return $this->returnValidationErrors($validator);
		}

		// Update the ingredient details
		$ingredient->update(['name'     => $request->get('name'),
							 'quantity' => $request->get('quantity')]);

		return new RecipeIngredient($ingredient);
	}

	/**
	 * @param \App\Models\Recipe\Recipe     $recipe
	 * @param \App\Models\Recipe\Ingredient $ingredient
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function delete(Recipe $recipe, Ingredient $ingredient)
	{
		if ($recipe->id != $ingredient->recipe_id) {
			return $this->returnError('Recipe-Ingredient relationship not matching');
		}

		// Delete the ingredient..
		$ingredient->delete();

		return $this->returnSuccess('Ingredient deleted successfully');
	}
}
