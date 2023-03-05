<div class="modal fade" id="delete-item-{{ $item->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    <i class="fa-solid fa-trash-can"></i>アイテム削除
                </h5>
            </div>
                <form action="{{ route('item.destroy', $item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        本当に”{{ $item->name }}”を削除しますか？
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-danger btn-sm px-3">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
