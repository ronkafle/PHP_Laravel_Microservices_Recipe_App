<?php

namespace App\Models\Recipe;


use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Recipe
 *
 * @property int    $id
 * @property int    $recipe_id
 * @property int    $step_order
 * @property string $description
 */
class Step extends Model
{
	/* @var boolean $timestamps */
	public $timestamps = true;

	/* @var string $table */
	protected $table = 'recipe_steps';

	/* @var array */
	protected $fillable = ['recipe_id', 'step_order', 'description'];
}
