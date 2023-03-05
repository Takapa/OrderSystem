@extends('layouts.app')

@section('title', 'Cart')

@section('content')
        <div class="text-center h2">カート一覧</div>
            <table class="table table-bordered mx-auto mt-3">
                <thead class="table table-dark">
                    <tr class="text-center">
                        <th>商品名</th>
                        <th>金額</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table table-light align-middle">
                    @forelse($user->carts as $cart)
                    <tr>
                        <td class="text-center">{{ $cart->item->name }}</td>
                        <td class="text-end" name="price[]">{{ number_format($cart->item->price) }}円</td>
                        <td class="text-end">
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                         @empty
                        <td colspan="3" class="text-center py-3 h5 fw-bold">カートに商品はありません</td>
                    </tr>
                   
                    @endforelse
                </tbody>       
                <tfoot class="table table-secondary ">
                    <tr>
                        <td class="text-center">合計金額</td>
                        <?php $total = 0; 
                            foreach($user->carts as $cart){
                                $total = $total + $cart->item->price;
                            }
                        ?>
                        <td class="text-end">{{ number_format($total) }}円</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
@endsection