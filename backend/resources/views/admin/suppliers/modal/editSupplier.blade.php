<div class="modal fade" id="edit-supplier-{{ $supplier->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h5 class="modal-title text-warning" id="modalTitleId">
                    <i class="fa-solid fa-pen-to-square"></i>サプライヤー登録編集
                </h5>
            </div>
                <form action="{{ route('admin.suppliers.update',$supplier) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">会社名</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $supplier->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="tel_number" class="form-label fw-bold">電話番号</label>
                            <input type="number" name="tel_number" id="tel_number" class="form-control" value="{{ $supplier->tel_number }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">所在地</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $supplier->address }}">
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


