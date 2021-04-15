<?php

namespace App\Models\Recipe;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * A recipe has many ingredients and steps.
 *
 * @package App\Models\Recipe
 *
 * @property int    $id
 * @property string $title
 * @property string $description
 * @property string $user_id
 */
class Recipe extends Model
{
	/* @var string $table */
	protected $table = 'recipes';

	/* @var boolean $timestamps */
	public $timestamps = true;

	/* @var array */
	protected $fillable = ['user_id', 'title', 'description', 'image_path'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ingredients()
	{
		return $this->hasMany(Ingredient::class, 'recipe_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function steps()
	{
		return $this->hasMany(Step::class, 'recipe_id', 'id')
					->orderBy('step_order');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
