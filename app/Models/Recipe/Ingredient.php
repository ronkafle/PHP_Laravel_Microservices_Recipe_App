<?php

namespace App\Models\Recipe;


use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Recipe
 *
 * @property int    $id
 * @property int    $recipe_id
 * @property string $name
 * @property int    $quantity
 */
class Ingredient extends Model
{
	/* @var string */
	protected $table = 'recipe_ingredients';

	/* @var boolean */
	public $timestamps = true;

	/* @var array */
	protected $fillable = ['recipe_id', 'name', 'quantity'];
}
