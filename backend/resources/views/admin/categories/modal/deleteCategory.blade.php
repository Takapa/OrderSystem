<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    <i class="fa-solid fa-trash-can"></i>カテゴリー削除
                </h5>
            </div>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        本当に”{{ $category->name }}”を削除しますか？
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
