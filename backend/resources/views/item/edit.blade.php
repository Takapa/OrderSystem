@extends('layouts.app')

@section('content')

<form action="{{ route('item.update', $item->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label fw-bold" autofocus>商品名</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}">
        </div>
        {{-- Error --}}
        @error('name')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
    
        <div class="mb-3">
            <label for="price" class="form-label fw-bold">価格</label>
            <input type="number" name="price" id="price" class="form-control"  value="{{ $item->price }}">
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
                    @if ( $unit->id == $item->unit_id)
                        <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                    @else
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endif
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
                    @if ( $category->id == $item->category_id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        {{-- Error --}}
        @error('category_id')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
    
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">詳細</label>
            <textarea name="description" id="description"  rows="3" class="form-control">{{ ($item->description) }}</textarea>
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
                    @if ( $supplier->id == $item->supplier_id)
                        <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                     @else
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        {{-- Error --}}
        @error('supplier_id')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
    
        <div class="row">
            <div class="col-6">
                <label for="image1" class="form-label fw-bold">画像1</label><br>
                <img src="{{ asset('/storage/images/' . $item->image1) }}" alt="{{ $item->image1 }}" class="w-25">
                <input type="file" name="image1" id="image1" class="form-control" value="{{ ($item->image1) }}">
                {{-- Error --}}
                @error('image1')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 position-relative">
                <label for="image2" class="form-label fw-bold">画像2</label><br>
                <img src="{{ asset('/storage/images/' . $item->image2) }}" alt="{{ $item->image2 }}" class="w-25">
                <input type="file" name="image2" id="image2" class="form-control position-absolute bottom-0 start-0" value="{{ ($item->image2) }}">
                {{-- Error --}}
                @error('image2')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-text mb-3">
            The acceptable formats are jpeg, jpg, png , and gif only <br>
            Max file size is 1048kb.
        </div>
        <a href="{{ route('index') }}" class="btn btn-outline-success btn-sm px-2">キャンセル</a>
        <button type="submit" class="btn btn-success btn-sm px-5">変更</button>
</form>

@endsection