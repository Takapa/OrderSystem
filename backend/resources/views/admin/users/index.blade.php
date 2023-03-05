@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')

    @if ($errors->any())
	<div class="alert alert-danger">そのEメールアドレスはすでに使用されています</div>
	@endif

    <table class=" table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メール</th>
                <th>権限ナンバー</th>
                <th>編集</th>
                <th>状態</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
                <tr>
                    <td class="text-decoration-none text-dark fw-bold">{{ $user->id }}</td>
                    <td class="text-decoration-none text-dark fw-bold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_id }}</td>
                    <td>
                        @if($user->deleted_at == NULL)
                            <button class="text-warning border border-none" data-bs-toggle="modal"
                                data-bs-target="#edit-user-{{ $user->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>編集
                            </button>
                            @include('admin.users.modal.editUser')
                        @endif
                    </td>
                    <td>
                        @if ($user->trashed())
                            <i class="fa-solid fa-circle text-danger"></i> &nbsp;使用不可
                        @else
                            <i class="fa-solid fa-circle text-success"></i> &nbsp;使用可
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->id != $user->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                            @if($user->trashed())
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-success" data-bs-toggle="modal"
                                        data-bs-target="#deactivate-user-{{ $user->id }}">
                                        <i class="fa-solid fa-user-check"></i>操作可能に戻す
                                    </button>
                                </div>
                            </div>
                            @include('admin.users.modal.active')

                            @else
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deactivate-user-{{ $user->id }}">
                                        <i class="fa-solid fa-user-slash"></i>操作不可にする
                                    </button>
                                </div>
                            </div>
                            @include('admin.users.modal.inactive')
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($user->deleted_at == NULL)
                        <a href="{{ route('admin.password.change', $user->id) }}">パスワード変更</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
