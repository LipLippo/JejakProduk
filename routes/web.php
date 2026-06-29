<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('admin.dashboard');
});

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Transaction;
use App\Models\TransactionItem;

// Admin Routes - Dilindungi oleh middleware 'auth'
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () { 
        $transactions = Transaction::latest()->take(5)->get();
        $totalRevenue = Transaction::sum('total');
        $totalOrders = Transaction::count();
        return view('admin.dashboard', compact('transactions', 'totalRevenue', 'totalOrders')); 
    })->name('dashboard');
    
    Route::get('/pos', function () { 
        $products = Product::where('is_available', true)->with('category')->get();
        return view('admin.pos.index', compact('products')); 
    })->name('pos');
    
    Route::get('/products', function () { 
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products')); 
    })->name('products');
    
    Route::put('/products/{product}', function (Request $request, Product $product) {
        $product->update($request->all());
        return redirect()->back();
    })->name('products.update');
    
    Route::delete('/products/{product}', function (Product $product) {
        $product->delete();
        return redirect()->back();
    })->name('products.destroy');
    
    Route::get('/ingredients', function () { 
        $ingredients = Ingredient::latest()->get();
        return view('admin.ingredients.index', compact('ingredients')); 
    })->name('ingredients');
    
    Route::post('/ingredients', function (Request $request) {
        Ingredient::create($request->all());
        return redirect()->back();
    })->name('ingredients.store');
    
    Route::put('/ingredients/{ingredient}', function (Request $request, Ingredient $ingredient) {
        $ingredient->update($request->all());
        return redirect()->back();
    })->name('ingredients.update');
    
    Route::delete('/ingredients/{ingredient}', function (Ingredient $ingredient) {
        $ingredient->delete();
        return redirect()->back();
    })->name('ingredients.destroy');
    
    Route::get('/reports', function () {
        $transactions = Transaction::latest()->get();
        return view('admin.reports.index', compact('transactions'));
    })->name('reports');
    
    Route::post('/checkout', function (Request $request) {
        $items = json_decode($request->input('items'), true);
        
        if (empty($items)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }
        
        // Pre-load semua produk berdasarkan nama agar tidak query N+1
        $productNames = collect($items)->pluck('name')->toArray();
        $productMap = Product::whereIn('name', $productNames)->get()->keyBy('name');
        
        $subtotal = collect($items)->sum('total');
        $total = $subtotal;
        $amountPaid = $request->input('payment_method') === 'QRIS' ? $total : (int) $request->input('amount_paid');
        $change = max(0, $amountPaid - $total);
        
        $transaction = Transaction::create([
            'user_id'        => auth()->id(),
            'invoice_number' => Transaction::generateInvoiceNumber(),
            'subtotal'       => $subtotal,
            'discount'       => 0,
            'total'          => $total,
            'amount_paid'    => $amountPaid,
            'change_amount'  => $change,
            'status'         => 'completed',
            'payment_method' => strtolower($request->input('payment_method', 'cash')),
            'notes'          => $request->input('notes'),
        ]);
        
        foreach ($items as $item) {
            $product = $productMap->get($item['name']);
            if (!$product) continue; // skip jika produk tidak ditemukan
            
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $product->id,
                'product_name'   => $item['name'],
                'product_price'  => $item['price'],
                'quantity'       => $item['qty'],
                'subtotal'       => $item['total'],
            ]);
        }
        
        return redirect()->route('admin.reports')->with('success', 'Transaksi berhasil! Invoice: ' . $transaction->invoice_number);
    })->name('checkout');
});
