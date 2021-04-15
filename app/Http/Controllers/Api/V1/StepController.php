<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\RecipeStep;
use App\Models\Recipe\Step;
use App\Models\Recipe\Recipe;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 */
class StepController extends ApiController
{
	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function getAll(Recipe $recipe)
	{
		return RecipeStep::collection($recipe->steps);
	}

	/**
	 * @param Recipe $recipe
	 * @param Step   $step
	 *
	 * @return \App\Http\Resources\RecipeStep|\Illuminate\Http\JsonResponse
	 */
	public function show(Recipe $recipe, Step $step)
	{
		if ($recipe->id != $step->recipe_id) {
			return $this->returnError('Recipe-Step relationship not matching');
		}

		return new RecipeStep($step);
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 * @param \Illuminate\Http\Request  $request
	 *
	 * @return \App\Http\Resources\RecipeStep
	 */
	public function store(Recipe $recipe, Request $request)
	{
		$validatedData = $request->validate(['description' => 'required|string',
											 'step_order'  => 'required|int']);

		$step = Step::create(['step_order'  => $validatedData['name'],
							  'description' => $validatedData['quantity'],
							  'recipe_id'   => $recipe->id]);

		return new RecipeStep($step);
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 * @param \App\Models\Recipe\Step   $step
	 * @param \Illuminate\Http\Request  $request
	 *
	 * @return \App\Http\Resources\RecipeStep|\Illuminate\Http\JsonResponse
	 */
	public function update(Recipe $recipe, Step $step, Request $request)
	{
		if ($recipe->id != $step->recipe_id) {
			return $this->returnError('Recipe-Step relationship not matching');
		}

		$validator = \Validator::make($request->all(), ['description' => 'string|required',
														'step_order'  => 'int|required']);

		if ($validator->fails()) {
			return $this->returnValidationErrors($validator);
		}

		// Update the step details
		$step->update(['description' => $request->get('description'),
					   'step_order'  => $request->get('step_order')]);

		return new RecipeStep($step);
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 * @param \App\Models\Recipe\Step   $step
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function delete(Recipe $recipe, Step $step)
	{
		if ($recipe->id != $step->recipe_id) {
			return $this->returnError('Recipe-Step relationship not matching');
		}

		// Delete the step..
		$step->delete();

		return $this->returnSuccess('Step deleted successfully');
	}
}
