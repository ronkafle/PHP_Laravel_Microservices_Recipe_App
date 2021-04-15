<?php

namespace Tests\Feature;


use App\Models\Recipe\Recipe;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\User;


class RecipeTest extends TestCase
{
	private $loginToken;

	static private $authHeaders = [];

	public function setUp(): void
	{
		parent::setUp();

		$this->loginToken = env('API_TOKEN');

		self::$authHeaders = ['Authorization' => 'Bearer ' . $this->loginToken];
	}

	/**
	 * create new Recipe test.
	 *
	 * @return void
	 */
	public function testGetAllRecipes()
	{
		$response = $this->get('/api/recipes', self::$authHeaders);

		$response->assertStatus(200);

		// Match the count with db..
		$recipes = Recipe::all();

		$this->assertEquals($recipes->count(), count($response->json('data')));
	}

	/**
	 * @return void
	 */
	public function testCreateRecipeSuccess()
	{
		$title       = 'Romanian apple cake ' . rand(1, 1000000);
		$description = 'This is a wonderfully simple, yet delicious cake! It is so moist and fresh, it will surely be a favorite with your family, just like it is with mine! The main length of the preparation time is cutting and peeling the apples. A mixture of apples works great, although I usually use Golden Delicious.';

		$response = $this->post('/api/recipes', [
			'title'       => $title,
			'description' => $description
		], self::$authHeaders);

		$response->assertStatus(201)
				 ->assertJson(['data' => ['title'       => $title,
										  'description' => $description]]);

		$recipeID = $response->json('data.id');

		$recipe = Recipe::find($recipeID);

		$this->assertEquals($recipe->title, $response->json('data.title'));
	}

	/**
	 * @return void
	 */
	public function testCreateRecipeFailDueToValidationError()
	{
		$title       = 'Romanian apple cake - 2';
		$description = '';

		$response = $this->post('/api/recipes', [
			'title'       => $title,
			'description' => $description
		], self::$authHeaders);

		// Asserting bad request response
		$response->assertStatus(400);
	}

	/**
	 * @return void
	 */
	public function testCreateRecipeFailDueToUnauthorisedUser()
	{
		$title       = 'Romanian apple cake - 2';
		$description = '';

		$response = $this->post('/api/recipes', [
			'title'       => $title,
			'description' => $description
		], ['Authorization' => 'Bearer abcdasdfasdf']);

		// Asserting unauthorised user response
		$response->assertStatus(401);
	}
}
