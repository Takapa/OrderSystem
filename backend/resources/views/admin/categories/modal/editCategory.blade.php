<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h5 class="modal-title text-warning" id="modalTitleId">
                    <i class="fa-solid fa-pen-to-square"></i>カテゴリー名変更
                </h5>
            </div>
            <form action="{{ route('admin.categories.update',$category) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-warning btn-sm">変更</button>
                </form>
            </div>
        </div>
    </div>
</div>
