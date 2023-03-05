@extends('layouts.app')

@section('content')

<h2 class="text-center">商品検索</h2>
<div class="row mt-3">
    <form method="GET" action="{{ route('search')}}">
    @csrf
      <div class="row mb-1">
        <label class="col-sm-2 col-form-label">検索ワード</label>
        <!--入力-->
        <div class="col-sm-5">
          <input type="text" class="form-control" name="searchWord" value="{{ $searchWord }}">
        </div>
        <div class="col-sm-auto">
          <button type="submit" class="btn btn-primary px-3">検索</button>
        </div>
      </div>     
      <!--プルダウンカテゴリ選択-->
      <div class="row mb-1">
        <label class="col-sm-2">商品カテゴリー</label>
        <div class="col-sm-3">
          <select name="categoryId" class="form-control" value="{{ $categoryId }}">
            <option value="" hidden>未選択</option>

            @foreach($categories as $id => $category_name)
            <option value="{{ $id }}">
              {{ $category_name }}
            </option>  
            @endforeach
          </select>
        </div>
      </div>
      <!--プルダウンサプライヤー選択-->
      <div class="row">
        <label class="col-sm-2">サプライヤー</label>
        <div class="col-sm-3">
          <select name="supplierId" class="form-control" value="{{ $supplierId }}">
            <option value="" hidden>未選択</option>

            @foreach($suppliers as $id => $supplier_name)
            <option value="{{ $id }}">
              {{ $supplier_name }}
            </option>  
            @endforeach
          </select>
        </div>
      </div>
    </form>
</div>
</div>


<table class="table table-hover align-middle bg-white border text-secondary mt-5">
    <thead class="small table-success text-secondary">
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <th>カテゴリー</th>
            <th>価格</th>
            <th>単位</th>
            <th>詳細</th>
            <th>サプライヤー</th>
            <th style="width: 110px;">カートに入れる</th>
            <th style="width: 50px;">編集</th>
            <th style="width: 50px;">削除</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ $item->category->name }}</td>
                <td>{{ number_format($item->price) }}</td>
                <td>{{ $item->unit->name }}</td>
                <td class="text-truncate" style="max-width: 220px;">{{ $item->description }}</td>
                <td>{{ $item->supplier->name }}</td>
                <td class="text-center">
                    <form action="#" method="get">
                    @csrf
                        <button class="text-warning border border-none">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </td>  
                <td>
                    <form action="{{ route('item.edit', $item->id) }}" method="get">
                    @csrf
                        <button type="submit" class="text-success border border-none">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </td>    
                <td>
                    <button type="submit" class="text-danger border border-none" data-bs-toggle="modal"
                    data-bs-target="#delete-item-{{ $item->id }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    @include('item.modal.deleteItem')
                </td>
            @empty
                <td colspan="10" class="fw-bold text-center py-3">検索ワードに該当するものはありませんでした</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {!! $items->links() !!}
</div>

@endsection
