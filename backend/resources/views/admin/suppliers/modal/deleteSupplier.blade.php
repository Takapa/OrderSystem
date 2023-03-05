<div class="modal fade" id="delete-supplier-{{ $supplier->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    <i class="fa-solid fa-trash-can"></i>サプライヤー削除
                </h5>
            </div>
                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        本当に”{{ $supplier->name }}”を削除しますか？
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
