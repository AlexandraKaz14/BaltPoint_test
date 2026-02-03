@extends('layout')

@section('title', 'Товары')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                <i class="bi bi-box-seam text-primary"></i> Товары
            </h1>
            <p class="text-muted mb-0">Всего товаров: {{ $products->total() }}</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Добавить товар
        </a>
    </div>

    @if($products->isEmpty())
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-box display-1 text-muted"></i>
                </div>
                <h4 class="mb-3">Товаров пока нет</h4>
                <p class="text-muted mb-4">Добавьте первый товар</p>
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Добавить товар
                </a>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Категория</th>
                            <th>Цена ₽</th>
                            <th style="width: 140px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="text-muted">#{{ $product->id }}</td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                </td>
                                <td>
                                    @if($product->description)
                                        <small class="text-muted">
                                            {{ Str::limit($product->description, 50) }}
                                        </small>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge rounded-pill bg-warning text-dark">
                                                {{ $product->category->name }}
                                            </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->price}} </strong>
                                </td>
                                <td style="width: 140px;">
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group me-2 mb-2" role="group">
                                            <a href="{{ route('products.edit', $product) }}"
                                               class="btn btn-primary"
                                               title="Редактировать">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('products.destroy', $product) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  data-confirm="Удалить товар '{{ $product->name }}'?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger"
                                                        title="Удалить">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($products->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Показано {{ $products->firstItem() }}–{{ $products->lastItem() }} из {{ $products->total() }} товаров
                        </div>
                        <div>
                            <div class="btn-group btn-group-sm">
                                @if (!$products->onFirstPage())
                                    <a href="{{ $products->previousPageUrl() }}" class="btn btn-outline-secondary">
                                        &laquo; Назад
                                    </a>
                                @endif

                                <button type="button" class="btn btn-outline-secondary disabled">
                                    Страница {{ $products->currentPage() }} из {{ $products->lastPage() }}
                                </button>

                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="btn btn-outline-secondary">
                                        Вперед &raquo;
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif

@endsection
