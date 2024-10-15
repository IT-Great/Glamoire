<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar kategori dan subkategori
        $categories = [
            'MAKEUP' => [
                'Cushion',
                'Foundation',
                'BB & CC Cream',
                'Tinted Moisturizer',
                'Cake Foundation',
                'Loose Powder',
                'Pressed Powder',
                'Bronzer',
                'Blush',
                'Contour',
                'Concealer',
                'Highlighter',
                'Face Primer',
                'Setting Spray',
                'Face Palette',
                'Eyebrows',
                'Eyeshadow',
                'Eyeliner',
                'False Eyelashes',
                'Mascara',
                'Eye Tape',
                'Lipstick',
                'Lip Cream',
                'Lip Liner',
                'Lip Tint',
                'Lip Gloss',
                'Lip Crayon',
                'Lip Stain',
                'Lip Primer',
                'Makeup Palettes & Set',
            ],
            'SKINCARE' => [
                'Acne / Pimple Patch',
                'Acne Treatment / Sealing gel / Cream',
                'Toner',
                'Essence',
                'Face Serum',
                'Booster',
                'Ampoule',
                'Nose Pack',
                'Face Wash',
                'Makeup Remover',
                'Cleansing Oil',
                'Cleansing Balm',
                'Cleansing Wipes',
                'Cleansing Cream',
                'Cleansing Gel',
                'Cleansing Bar',
                'Cleansing Powder',
                'Scrub & Exfoliator',
                'Micellar Water',
                'Peeling',
                'Sheet Mask',
                'Clay Mask',
                'Wash off Mask',
                'Peel Off Mask',
                'Sleeping Mask',
                'Face Oil',
                'Face Cream & Lotion',
                'Face Mist',
                'Face Gel',
                'Touch-ups Sunscreen',
                'Sunscreen',
                'After Sun Care',
                'Eye Serum',
                'Eye Cream',
                'Eyelash Serum',
                'Eye Mask',
                'Lip Balm',
                'Lip Mask',
                'Lip Scrub',
                'Lip Serum',
            ],
            'HAIRCARE' => [
                'Shampoo',
                'Dry Shampoo',
                'Hair Brushes & Combs',
                'Hair Dryers',
                'Hair Straightener, Curling Iron, Hair Styler',
                'Hair Accessories',
                'Hair Lotion',
                'Hair Serum',
                'Hair Mask',
                'Hair Oil',
                'Conditioner',
                'Hair Tonic',
                'Hair Vitamin',
                'Hair Essence',
                'Leave-In Treatment',
                'Wax, Gel, Pomade',
                'Styling Cream, Foam, Mousse',
                'Hair Color',
                'Hair Spray',
                'Hair Mist',
            ],
            'GIFT SET' => [],
            'BATH BODY' => [
                'Hand & Foot Mask',
                'Cellulite & Stretch Marks',
                'Breast Care',
                'Body Sunscreen',
                'Body Sun Care',
                'Tanning',
                '2in1 Body Wash/Head-to-toe Wash',
                'Body Wash',
                'Body Scrub & Exfoliants',
                'Hand Wash',
                'Hand Sanitizer',
                'Deodorant',
                'Body Lotion / Body Serum',
                'Body Oil',
                'Body Butter & Cream',
                'Hand & Foot Cream',
                'Foot Spray',
            ],
            'ACCESSORIES' => [
                'Travel Bottles & Makeup case',
                'Shower Cap',
                'Body Sponge',
                'Makeup Pouch',
                'Cotton Pad',
                'Cleansing Brushes',
                'Blotting Paper',
                'Facial Tools',
                'Face Brushes',
                'Lip Brushes',
                'Eye Brushes',
                'Sponge & Applicators',
                'Brush Cleanser & Tools',
                'Brush Set',
                'Eyelash Glue',
                'Tweezers',
                'Palette',
                'Eyelash Curler',
                'Sharpeners & Clippers',
                'Brow Tools',
                'Mirror',
            ],
            'FRAGRANCE' => [
                'Eau De Parfum',
                'Eau De Toilette',
                'Body Mist',
                'Perfume Oil',
                'Essential Oil',
                'Aromatherapy',
                'Room Spray',
                'Scented Candles and Reed Diffuser',
            ],
            'MEN' => [
                'Men Face Wash',
                'Men Scrub & Exfoliator',
                'Men Moisturizer',
                'Men Body Wash',
                'Men Deodorant',
                'Men Pomade, Wax, & Gel',
                'Men Styling Cream, Foam, Mousse',
                'Men Shampoo',
                'Hair Tonic',
                'Men Shaving Cream & Gel',
                'Men Shaver & Clipper',
                'Comb',
                'Men Eau De Parfum',
                'Men Eau De Toilette',
                'Men Cologne',
            ],
            'HOME CARE' => [
                'Multi-purpose Sanitizer',
            ],
            'ORAL CARE' => [
                'Toothpaste',
                'Mouthwash',
                'Tooth Whitening',
            ],
            'SANITARY' => [
                'Feminine sanitary',
                'Pads',
                'Tampons',
                'Panty Liners',
            ],
            'SHAVING & GROOMING' => [
                'Hair Removal Care',
                'Shaving Cream & Gel',
                'Shaver and Clipper',
            ],
            'NAIL CARE' => [
                'Nail Polish',
                'Nail Polish Remover',
                'Nail Treatment',
                'Nail Arts',
                'Nail Clippers & Files',
                'Manicure & Pedicure Set',
            ]
        ];

        // Loop through categories
        foreach ($categories as $categoryName => $subcategories) {
            // Create category
            $category = CategoryProduct::create([
                'name' => $categoryName,
                'parent_id' => null, // Null for main category
            ]);

            // Create subcategories
            foreach ($subcategories as $subcategoryName) {
                CategoryProduct::create([
                    'name' => $subcategoryName,
                    'parent_id' => $category->id, // Link to the parent category
                ]);
            }
        }
    }
}
