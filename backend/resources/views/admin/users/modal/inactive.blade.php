    <div class="modal fade" id="deactivate-user-{{ $user->id }}">
        <div class="modal-dialog " role="document">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger" id="modalTitleId">
                        <i class="fa-solid fa-user-slash"></i>操作不可設定
                    </h5>

                </div>
                <div class="modal-body">
                    本当に”<span class="fw-bold">{{ $user->name }}</span>”を操作不可にしますか？
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.deactivate',$user->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
