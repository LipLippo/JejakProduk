<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─────────────────────────────────────────────
        // 1. USER ADMIN
        // ─────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@jejakproduk.com'],
            [
                'name'     => 'Admin UMKM',
                'password' => Hash::make('password123'),
            ]
        );

        // ─────────────────────────────────────────────
        // 2. KATEGORI PRODUK
        // ─────────────────────────────────────────────
        $categories = [
            ['name' => 'Minuman Dingin',  'type' => 'Minuman', 'color' => '#10B981'],
            ['name' => 'Minuman Panas',   'type' => 'Minuman', 'color' => '#F59E0B'],
            ['name' => 'Makanan Utama',   'type' => 'Makanan', 'color' => '#EF4444'],
            ['name' => 'Makanan Ringan',  'type' => 'Makanan', 'color' => '#8B5CF6'],
            ['name' => 'Topping',         'type' => 'Topping', 'color' => '#EC4899'],
            ['name' => 'Lainnya',         'type' => 'Lainnya', 'color' => '#64748B'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat['name']], $cat);
        }

        $catMinumanDingin = Category::where('name', 'Minuman Dingin')->first();
        $catMinumanPanas  = Category::where('name', 'Minuman Panas')->first();
        $catMakananUtama  = Category::where('name', 'Makanan Utama')->first();
        $catMakananRingan = Category::where('name', 'Makanan Ringan')->first();
        $catTopping       = Category::where('name', 'Topping')->first();

        // ─────────────────────────────────────────────
        // 3. BAHAN BAKU
        // ─────────────────────────────────────────────
        $ingredients = [
            ['name' => 'Teh Celup',       'unit' => 'pcs',   'stock' => 500,  'min_stock' => 50,  'cost_per_unit' => 400,   'description' => 'Teh celup premium'],
            ['name' => 'Gula Pasir',       'unit' => 'gram',  'stock' => 5000, 'min_stock' => 500, 'cost_per_unit' => 15,    'description' => 'Gula pasir putih'],
            ['name' => 'Es Batu',          'unit' => 'gram',  'stock' => 10000,'min_stock' => 1000,'cost_per_unit' => 2,     'description' => 'Es batu kristal'],
            ['name' => 'Air Panas',        'unit' => 'ml',    'stock' => 50000,'min_stock' => 5000,'cost_per_unit' => 0.5,   'description' => 'Air minum panas'],
            ['name' => 'Susu Full Cream',  'unit' => 'ml',    'stock' => 5000, 'min_stock' => 500, 'cost_per_unit' => 12,    'description' => 'Susu segar full cream'],
            ['name' => 'Jeruk Lemon',      'unit' => 'buah',  'stock' => 100,  'min_stock' => 10,  'cost_per_unit' => 3000,  'description' => 'Jeruk lemon segar'],
            ['name' => 'Boba Pearl',       'unit' => 'gram',  'stock' => 2000, 'min_stock' => 200, 'cost_per_unit' => 80,    'description' => 'Boba pearl hitam'],
            ['name' => 'Jelly Cincau',     'unit' => 'gram',  'stock' => 1500, 'min_stock' => 150, 'cost_per_unit' => 50,    'description' => 'Jelly cincau hijau'],
            ['name' => 'Gelas Plastik',    'unit' => 'pcs',   'stock' => 500,  'min_stock' => 100, 'cost_per_unit' => 500,   'description' => 'Gelas plastik 16oz'],
            ['name' => 'Sedotan',          'unit' => 'pcs',   'stock' => 500,  'min_stock' => 100, 'cost_per_unit' => 150,   'description' => 'Sedotan boba jumbo'],
            ['name' => 'Nasi Putih',       'unit' => 'gram',  'stock' => 10000,'min_stock' => 1000,'cost_per_unit' => 10,    'description' => 'Beras pera dimasak'],
            ['name' => 'Ayam Fillet',      'unit' => 'gram',  'stock' => 3000, 'min_stock' => 300, 'cost_per_unit' => 40,    'description' => 'Ayam fillet tanpa tulang'],
            ['name' => 'Tepung Terigu',    'unit' => 'gram',  'stock' => 5000, 'min_stock' => 500, 'cost_per_unit' => 8,     'description' => 'Tepung protein tinggi'],
            ['name' => 'Minyak Goreng',    'unit' => 'ml',    'stock' => 5000, 'min_stock' => 500, 'cost_per_unit' => 20,    'description' => 'Minyak kelapa sawit'],
            ['name' => 'Kerupuk',          'unit' => 'pcs',   'stock' => 200,  'min_stock' => 20,  'cost_per_unit' => 500,   'description' => 'Kerupuk udang'],
            ['name' => 'Coklat Bubuk',     'unit' => 'gram',  'stock' => 1000, 'min_stock' => 100, 'cost_per_unit' => 120,   'description' => 'Coklat bubuk premium'],
        ];

        $ingModels = [];
        foreach ($ingredients as $ing) {
            $ingModels[$ing['name']] = Ingredient::firstOrCreate(['name' => $ing['name']], $ing);
        }

        // ─────────────────────────────────────────────
        // 4. PRODUK
        // ─────────────────────────────────────────────
        $products = [
            // Minuman Dingin
            [
                'category_id' => $catMinumanDingin->id,
                'name'        => 'Es Teh Original',
                'description' => 'Teh segar dengan es batu yang menyegarkan',
                'price'       => 5000,  'cost_price' => 1500,
                'stock'       => 100,   'initials' => 'ET',  'avatar_color' => 'green',
                'ingredients' => [
                    ['name' => 'Teh Celup', 'qty' => 1],
                    ['name' => 'Gula Pasir', 'qty' => 20],
                    ['name' => 'Es Batu',    'qty' => 150],
                    ['name' => 'Gelas Plastik', 'qty' => 1],
                    ['name' => 'Sedotan',       'qty' => 1],
                ],
            ],
            [
                'category_id' => $catMinumanDingin->id,
                'name'        => 'Es Teh Kampul',
                'description' => 'Teh dengan campuran susu segar yang gurih',
                'price'       => 7000,  'cost_price' => 2500,
                'stock'       => 80,    'initials' => 'EK',  'avatar_color' => 'orange',
                'ingredients' => [
                    ['name' => 'Teh Celup',    'qty' => 1],
                    ['name' => 'Gula Pasir',   'qty' => 25],
                    ['name' => 'Es Batu',      'qty' => 100],
                    ['name' => 'Susu Full Cream', 'qty' => 50],
                    ['name' => 'Gelas Plastik', 'qty' => 1],
                    ['name' => 'Sedotan',       'qty' => 1],
                ],
            ],
            [
                'category_id' => $catMinumanDingin->id,
                'name'        => 'Es Teh Lemon',
                'description' => 'Teh segar dengan perasan lemon asli',
                'price'       => 8000,  'cost_price' => 3000,
                'stock'       => 60,    'initials' => 'EL',  'avatar_color' => 'blue',
                'ingredients' => [
                    ['name' => 'Teh Celup',   'qty' => 1],
                    ['name' => 'Gula Pasir',  'qty' => 15],
                    ['name' => 'Es Batu',     'qty' => 150],
                    ['name' => 'Jeruk Lemon', 'qty' => 0.5],
                    ['name' => 'Gelas Plastik', 'qty' => 1],
                    ['name' => 'Sedotan',       'qty' => 1],
                ],
            ],
            [
                'category_id' => $catMinumanDingin->id,
                'name'        => 'Es Boba Teh',
                'description' => 'Teh susu dengan boba pearl kenyal',
                'price'       => 15000, 'cost_price' => 6000,
                'stock'       => 50,    'initials' => 'EB',  'avatar_color' => 'purple',
                'ingredients' => [
                    ['name' => 'Teh Celup',    'qty' => 1],
                    ['name' => 'Gula Pasir',   'qty' => 30],
                    ['name' => 'Es Batu',      'qty' => 100],
                    ['name' => 'Susu Full Cream', 'qty' => 80],
                    ['name' => 'Boba Pearl',   'qty' => 50],
                    ['name' => 'Gelas Plastik', 'qty' => 1],
                    ['name' => 'Sedotan',       'qty' => 1],
                ],
            ],
            [
                'category_id' => $catMinumanDingin->id,
                'name'        => 'Es Coklat Susu',
                'description' => 'Minuman coklat dingin dengan susu',
                'price'       => 12000, 'cost_price' => 4500,
                'stock'       => 70,    'initials' => 'EC',  'avatar_color' => 'amber',
                'ingredients' => [
                    ['name' => 'Coklat Bubuk',  'qty' => 20],
                    ['name' => 'Gula Pasir',    'qty' => 25],
                    ['name' => 'Es Batu',       'qty' => 150],
                    ['name' => 'Susu Full Cream','qty' => 100],
                    ['name' => 'Gelas Plastik', 'qty' => 1],
                    ['name' => 'Sedotan',       'qty' => 1],
                ],
            ],
            // Minuman Panas
            [
                'category_id' => $catMinumanPanas->id,
                'name'        => 'Teh Tarik Panas',
                'description' => 'Teh susu klasik disajikan panas',
                'price'       => 8000,  'cost_price' => 2500,
                'stock'       => 90,    'initials' => 'TT',  'avatar_color' => 'yellow',
                'ingredients' => [
                    ['name' => 'Teh Celup',    'qty' => 2],
                    ['name' => 'Gula Pasir',   'qty' => 20],
                    ['name' => 'Air Panas',    'qty' => 150],
                    ['name' => 'Susu Full Cream', 'qty' => 50],
                ],
            ],
            // Makanan Utama
            [
                'category_id' => $catMakananUtama->id,
                'name'        => 'Ayam Goreng Crispy',
                'description' => 'Ayam goreng tepung renyah dengan nasi',
                'price'       => 20000, 'cost_price' => 9000,
                'stock'       => 30,    'initials' => 'AG',  'avatar_color' => 'red',
                'ingredients' => [
                    ['name' => 'Ayam Fillet',   'qty' => 150],
                    ['name' => 'Tepung Terigu', 'qty' => 50],
                    ['name' => 'Minyak Goreng', 'qty' => 100],
                    ['name' => 'Nasi Putih',    'qty' => 200],
                    ['name' => 'Kerupuk',       'qty' => 2],
                ],
            ],
            // Makanan Ringan
            [
                'category_id' => $catMakananRingan->id,
                'name'        => 'Pisang Goreng Crispy',
                'description' => 'Pisang goreng tepung renyah manis',
                'price'       => 8000,  'cost_price' => 2500,
                'stock'       => 40,    'initials' => 'PG',  'avatar_color' => 'yellow',
                'ingredients' => [
                    ['name' => 'Tepung Terigu', 'qty' => 80],
                    ['name' => 'Minyak Goreng', 'qty' => 100],
                    ['name' => 'Gula Pasir',    'qty' => 10],
                ],
            ],
        ];

        $productModels = [];
        foreach ($products as $prod) {
            $ingredientData = $prod['ingredients'] ?? [];
            unset($prod['ingredients']);

            $product = Product::firstOrCreate(['name' => $prod['name']], $prod);
            $productModels[] = $product;

            // Attach ingredients ke produk
            $syncData = [];
            foreach ($ingredientData as $ingData) {
                if (isset($ingModels[$ingData['name']])) {
                    $syncData[$ingModels[$ingData['name']]->id] = ['quantity_used' => $ingData['qty']];
                }
            }
            if (!empty($syncData)) {
                $product->ingredients()->sync($syncData);
            }
        }

        // ─────────────────────────────────────────────
        // 5. TOPPING
        // ─────────────────────────────────────────────
        $toppings = [
            ['name' => 'Topping Jelly',  'price' => 2000, 'cost_price' => 500,  'initials' => 'TJ', 'avatar_color' => 'pink',  'ingredient' => 'Jelly Cincau', 'qty' => 30],
            ['name' => 'Topping Boba',   'price' => 3000, 'cost_price' => 800,  'initials' => 'TB', 'avatar_color' => 'indigo', 'ingredient' => 'Boba Pearl',  'qty' => 30],
        ];

        $catTopping = Category::where('name', 'Topping')->first();
        foreach ($toppings as $top) {
            $ingredientName = $top['ingredient'];
            $ingredientQty  = $top['qty'];
            unset($top['ingredient'], $top['qty']);

            $top['category_id'] = $catTopping->id;
            $top['stock']       = 50;
            $top['description'] = 'Topping tambahan untuk minuman';

            $product = Product::firstOrCreate(['name' => $top['name']], $top);
            if (isset($ingModels[$ingredientName])) {
                $product->ingredients()->sync([
                    $ingModels[$ingredientName]->id => ['quantity_used' => $ingredientQty],
                ]);
            }
        }

        // ─────────────────────────────────────────────
        // 6. TRANSAKSI CONTOH (30 hari terakhir)
        // ─────────────────────────────────────────────
        $allProducts = Product::all();

        for ($day = 30; $day >= 1; $day--) {
            $date = now()->subDays($day);

            // 3–8 transaksi per hari
            $txCount = rand(3, 8);

            for ($t = 0; $t < $txCount; $t++) {
                $invoiceNumber = 'TRX-' . $date->format('Ymd') . '-' . str_pad($t + 1, 3, '0', STR_PAD_LEFT);

                // Buat 1–4 item per transaksi
                $selectedProducts = $allProducts->random(rand(1, 4));
                $items = [];
                $subtotal = 0;

                foreach ($selectedProducts as $p) {
                    $qty  = rand(1, 3);
                    $sub  = $p->price * $qty;
                    $subtotal += $sub;
                    $items[] = [
                        'product_id'    => $p->id,
                        'product_name'  => $p->name,
                        'product_price' => $p->price,
                        'quantity'      => $qty,
                        'subtotal'      => $sub,
                    ];
                }

                $discount    = 0;
                $total       = $subtotal - $discount;
                $amountPaid  = ceil($total / 5000) * 5000; // Dibulatkan ke kelipatan 5000
                $change      = $amountPaid - $total;

                $transaction = Transaction::create([
                    'user_id'         => $admin->id,
                    'invoice_number'  => $invoiceNumber,
                    'subtotal'        => $subtotal,
                    'discount'        => $discount,
                    'total'           => $total,
                    'amount_paid'     => $amountPaid,
                    'change_amount'   => $change,
                    'status'          => 'completed',
                    'payment_method'  => collect(['cash', 'transfer', 'qris'])->random(),
                    'notes'           => null,
                    'created_at'      => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                    'updated_at'      => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                ]);

                foreach ($items as $item) {
                    $item['transaction_id'] = $transaction->id;
                    TransactionItem::create($item);
                }
            }
        }

        $this->command->info('✅ Seeding selesai! Database JejakProduk telah berhasil diisi.');
        $this->command->info('   Admin  : admin@jejakproduk.com');
        $this->command->info('   Passwd : password123');
    }
}
