@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')

    @if ($errors->any())
	<div class="alert alert-danger">変更内容に間違いがあります。</div>
	@endif

    <table class=" table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th>ID</th>
                <th>会社名</th>
                <th>電話番号</th>
                <th>所在地</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->tel_number }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <button class="text-warning border border-none" data-bs-toggle="modal"
                            data-bs-target="#edit-supplier-{{ $supplier->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>編集
                        </button>
                        @include('admin.suppliers.modal.editSupplier')
                    </td>
                    <td>
                        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#delete-supplier-{{ $supplier->id }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        @include('admin.suppliers.modal.deleteSupplier')
                    </td>
                
            @empty
                    <td>取引先会社の登録はありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $all_suppliers->links() !!}
    </div>

    <form action="{{ route('admin.suppliers.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mt-2">
            <div class="card-header h3">
                サプライヤー登録
            </div>
            <div class="mb-3 card-body ms-2">
                <div class="row mb-3">
                    <div class="col-6">
                         <label for="name" class="form-label fw-bold">会社名</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="tel_number" class="form-label fw-bold">電話番号</label>
                        <input type="number" name="tel_number" id="tel_number" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <label for="address" class="form-label fw-bold">所在地</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-success px-5" style="margin-top: 30px;">登録</button>
                    </div>
                </div>
            </div>
        </div>
        
    </form>

@endsection
