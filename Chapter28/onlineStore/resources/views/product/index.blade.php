@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

<!-- Barre de filtrage par catégorie -->
<div class="row mb-4">
  <div class="col-md-4">
   <!-- Formulaire de filtrage -->
<form action="{{ route('product.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <select name="category_id" class="form-control" onchange="this.form.submit()">
            <option value="">Toutes les catégories</option>
            @foreach ($viewData["categories"] as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
          </option>          
            @endforeach
        </select>
    </div>
</form>

  </div>
</div>

<!-- Affichage des produits -->
<div class="row">
  @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3 mb-2">
      <div class="card">
        <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
        <div class="card-body text-center">
          <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="btn bg-primary text-white">
            {{ $product->getName() }}
          </a>
          <!-- Afficher la catégorie du produit -->
          @if ($product->getCategory())
            <p class="mt-2 text-muted small">{{ $product->getCategory()->getName() }}</p>
          @endif
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection
