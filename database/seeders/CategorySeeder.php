<?php
// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create categories without a parent first
        $categories = Category::factory()->count(5)->create();
        
        function createChild($category){
            if (rand(0, 1)) {
                $child = Category::factory()->create([
                    'father_id' => $category->id,
                ]);
    
                createChild($child);
            } 
        }
        
        // Assign some categories as children of the previously created categories
        foreach ($categories as $category) {
            createChild($category);
        }
        
    }
}
