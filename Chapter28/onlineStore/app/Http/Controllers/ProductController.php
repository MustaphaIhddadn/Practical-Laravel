<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // N'oublie pas d'importer Category
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $productsQuery = Product::query();

        // S'il y a une catégorie sélectionnée, on filtre
        if ($request->filled('category_id')) {
            $productsQuery->where('category_id', $request->input('category_id'));
        }

        $products = $productsQuery->get();

        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] = "List of products";
        $viewData["products"] = $products;
        $viewData["categories"] = $categories; // Ajouté pour l'affichage dans la vue

        return view('product.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = $product->getName() . " - Online Store";
        $viewData["subtitle"] = $product->getName() . " - Product information";
        $viewData["product"] = $product;
        return view('product.show')->with("viewData", $viewData);
    }
}
