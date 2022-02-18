<?php
# @Author: Codeals
# @Date:   04-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 01-11-2019
# @Copyright: Codeals

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('categories')->truncate();

        $category = array (
            [
        	    'category' => 'Cárnicos & Pescado',
            ],
            [
               'category' => 'Lácteos',
            ],
            [
                'category' => 'Básicos',
            ],
            [
                'category' => 'Frutas & Vegetales',
            ],
            [
                'category' => 'Viandas',
            ],
            [
                'category' => 'Limpieza y Aseo',
            ],
            [
                'category' => 'Productos no alimenticios',
            ],
            [
                'category' => 'Servicios',
            ],
            [
                'category' => 'Canastilla',
            ]
        );

        Category::insert($category);

        // $category = [
        // 	'category' => 'Carnicos & Pescado',
        // ];

        // Category::create($category);
    }
}
