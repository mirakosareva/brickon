<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use App\Models\User;

class FavoriteController extends Controller
{
    public function toggle(Product $product)
    {
        $user = Auth::user();
        
        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            $message = 'Удалено из избранного';
            $isFavorited = false;
        } else {
            $user->favorites()->attach($product->id);
            $message = 'Добавлено в избранное';
            $isFavorited = true;
        }
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_favorited' => $isFavorited
            ]);
        }
        
        return back()->with('success', $message);
    }
    
    public function index()
    {
        $products = Auth::user()->favorites()->paginate(12);
        return view('favorites.index', compact('products'));
    }
}
