<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Recipe extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function toArray($request)
	{
		$data = parent::toArray($request);

		return ['id'          => $data['id'],
				'title'       => $data['title'],
				'description' => $data['description'],
				'created_by'  => !empty($this->user) ? $this->user->name : '',
				'image_path'  => $data['image_path'],
				'ingredients' => RecipeIngredient::collection($this->ingredients),
				'steps'       => RecipeStep::collection($this->steps),
				'created_at'  => $data['created_at'],
				'updated_at'  => $data['updated_at'],
		];
	}
}
