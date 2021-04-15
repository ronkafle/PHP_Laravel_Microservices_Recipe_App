<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')
	 ->get('/user', function (Request $request) {
		 return $request->user();
	 });

Route::middleware('auth:api')
	 ->group(function () {
		 // Recipe
		 Route::get('recipes', 'Api\V1\RecipeController@getAll');
		 Route::get('recipes/{recipe}', 'Api\V1\RecipeController@show');

		 Route::post('recipes', 'Api\V1\RecipeController@store');
		 Route::put('recipes/{recipe}', 'Api\V1\RecipeController@update');
		 Route::delete('recipes/{recipe}', 'Api\V1\RecipeController@delete');

		 // Recipe's Ingredients CRUD APIs
		 Route::get('recipes/{recipe}/ingredients', 'Api\V1\IngredientController@getAll');
		 Route::get('recipes/{recipe}/ingredients/{ingredient}', 'Api\V1\IngredientController@show');
		 Route::post('recipes/{recipe}/ingredients', 'Api\V1\IngredientController@store');
		 Route::put('recipes/{recipe}/ingredients/{ingredient}', 'Api\V1\IngredientController@update');
		 Route::delete('recipes/{recipe}/ingredients/{ingredient}', 'Api\V1\IngredientController@delete');

		 // Step's Ingredients CRUD APIs
		 Route::get('recipes/{recipe}/steps', 'Api\V1\StepController@getAll');
		 Route::get('recipes/{recipe}/steps/{step}', 'Api\V1\StepController@show');
		 Route::post('recipes/{recipe}/steps', 'Api\V1\StepController@store');
		 Route::put('recipes/{recipe}/steps/{step}', 'Api\V1\StepController@update');
		 Route::delete('recipes/{recipe}/steps/{step}', 'Api\V1\StepController@delete');
	 });
