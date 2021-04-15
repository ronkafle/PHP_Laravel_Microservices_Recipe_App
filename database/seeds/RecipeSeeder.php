<?php

use Illuminate\Database\Seeder;

use App\Models\Recipe\Recipe;
use App\Models\Recipe\Ingredient;
use App\Models\Recipe\Step;

class RecipeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = \App\User::first();

		// Then, some ingredients..
		$ingredientData = [
			['name'     => 'Apples',
			 'quantity' => '5 pieces'],

			['name'     => 'Ground cinnamon',
			 'quantity' => '1 ts'],

			['name'     => 'Vanila Extract',
			 'quantity' => '1 ts'],
		];

		// Then, define the steps..
		$stepsData = [
			['step_order'  => 1,
			 'description' => 'Preheat oven to 350 degrees F (175 degrees C). Grease and flour a 9x13 inch pan. Cut the apples into 1 inch wedges. Set aside.'],

			['step_order'  => 2,
			 'description' => 'In a large bowl, whisk together the eggs and sugar until blended. Mix in the baking soda, oil, cinnamon and vanilla. Stir in the flour, just until incorporated. Fold in the apples and walnuts.'],

			['step_order'  => 3,
			 'description' => 'Pour batter into prepared pan. Bake in the preheated oven for 55 minutes, or until a toothpick inserted into the center of the cake comes out clean. Allow to cool slightly. May be served warm or at room temperature.'],
		];

		for($index = 1; $index <= 5; $index++) {
			// Create some recipe..
			$recipe = Recipe::create(['title'       => 'Romanian Apple Cake (' . \Illuminate\Support\Str::random(5) . ')',
									  'description' => 'This is a wonderfully simple, yet delicious cake! It is so moist and fresh, it will surely be a favorite with your family, just like it is with mine!',
									  'image_path'  => 'img/' . $index . '.jpg',
									  'user_id'     => $user->id]);

			self::createIngredients($recipe, $ingredientData);

			self::createSteps($recipe, $stepsData);
		}
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 * @param array                     $ingredientData
	 */
	static private function createIngredients(Recipe $recipe, array $ingredientData)
	{
		foreach($ingredientData as $ingredientDataRow) {
			Ingredient::create(array_merge(['recipe_id' => $recipe->id], $ingredientDataRow));
		}
	}

	/**
	 * @param \App\Models\Recipe\Recipe $recipe
	 * @param array                     $stepsData
	 */
	static private function createSteps(Recipe $recipe, array $stepsData)
	{
		foreach($stepsData as $stepsDataRow) {
			Step::create(array_merge(['recipe_id' => $recipe->id], $stepsDataRow));
		}
	}
}
