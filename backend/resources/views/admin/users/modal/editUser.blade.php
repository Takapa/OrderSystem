<div class="modal fade" id="edit-user-{{ $user->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h5 class="modal-title text-warning" id="modalTitleId">
                    <i class="fa-solid fa-pen-to-square"></i>ユーザー登録編集
                </h5>
            </div>
                <form action="{{ route('admin.update',$user->id) }}" method="post">
                @csrf
                @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">ユーザー名</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Eメール</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-warning btn-sm">変更</button>
                </form>
            </div>
        </div>
    </div>
</div>


