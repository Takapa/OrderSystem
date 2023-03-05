@extends('layouts.app')

@section('title','Create item')

@section('content')

<form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="mb-3">
        <label for="name" class="form-label fw-bold" autofocus>商品名</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    {{-- Error --}}
    @error('name')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="mb-3">
        <label for="price" class="form-label fw-bold">価格</label>
        <input type="number" name="price" id="price" class="form-control">
    </div>
    {{-- Error --}}
    @error('price')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="mb-3">
        <label for="unit_id" class="form-label fw-bold">単位</label>
        <select name="unit_id" id="" class="form-control">
            <option value="" hidden>選択してください</option>
            @foreach ($all_units as $unit)
                <option value="{{ $unit->id }}" class="form-check-input">{{ $unit->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- Error --}}
    @error('unit_id')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="mb-3">
        <label for="category_id" class="form-label fw-bold">カテゴリー</label>
        <select name="category_id" id="" class="form-control">
            <option value="" hidden>選択してください</option>
            @foreach ($all_categories as $category)
                <option value="{{ $category->id }}" class="form-check-input">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- Error --}}
    @error('category_id')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="mb-3">
        <label for="description" class="form-label fw-bold">詳細</label>
        <textarea name="description" id="description"  rows="3" class="form-control"></textarea>
    </div>
    {{-- Error --}}
    @error('description')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="mb-3">
        <label for="supplier_id" class="form-label fw-bold">サプライヤー</label>
        <select name="supplier_id" id="" class="form-control">
            <option value="" hidden>選択してください</option>
            @foreach ($all_suppliers as $supplier)
                <option value="{{ $supplier->id }}" class="form-check-input">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- Error --}}
    @error('supplier_id')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="mb-4">
        <label for="image" class="form-label fw-bold">画像1</label>
        <input type="file" name="image1" id="image1" class="form-control">
    </div>

    <div class="mb-4">
        <label for="image" class="form-label fw-bold">画像2</label>
        <input type="file" name="image2" id="image2" class="form-control">
        <div class="form-text">
            The acceptable formats are jpeg, jpg, png , and gif only <br>
            Max file size is 1048kb.
        </div>
    </div>

    <button type="submit" class="btn btn-primary px-5">登録</button>
</form>

@endsection
