@extends('layouts.app')

@section('title', 'detail item')

@section('content')
<section>
    <div class="row bg-white border">
        <div class="col-6 border">
            <div class="row border" style="height: 403px;">
                <div class="text-center main_img">
                    @if ($item->image1 or $item->image2)
                        @if ($item->image1 )
                            <img src="{{ asset('/storage/images/' . $item->image1) }}" style="width:300px; height:400px;">   
                        @else
                            <img src="{{ asset('/storage/images/' . $item->image2) }}" style="width:300px; height:400px;">   
                        @endif
                    @else
                        <img src="{{ asset('/storage/images/noimage.png/') }}" style="width:400px; height:590px;">
                    @endif
                </div>
            </div>
            <div class="row" style="height: 190px;">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8 ps-5 pt-2 sub_img">
                        @if ($item->image1)
                            <img src="{{ asset('/storage/images/' . $item->image1) }}" alt="{{ $item->image1 }}" class="border p-2 me-2" style="width:100px; height:170px; float:left;">
                        @endif
                        @if ($item->image2)
                            <img src="{{ asset('/storage/images/' . $item->image2) }}" alt="{{ $item->image2 }}" class="border p-2" style="width:100px; height:170px;">
                        @endif                
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
        <div class="col-6 border" style="position:relative;">
            <div class="h2 my-3">商品名：{{ $item->name }}</div>
            <div class="h2 my-3">カテゴリー：{{ $item->category->name }}</div>
            <div class="h2 my-3">単価：{{ number_format($item->price) }}円 / {{ $item->unit->name }}</div>
            <div class="h2 my-3">サプライヤー：{{ $item->supplier->name }}</div>
            <div class="h4 my-3">{{ $item->description }}</div>
            <a href="{{ route('index') }}" class="h4">商品一覧へ戻る</a>
        </div>
    </div>
</section>

<!------ Jquery (for switting picture) ------> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function()
        {
            $(".sub_img dt").eq(0).addClass("select");
            $(".sub_img img").click(function()
            {
                var img = $(this).attr("src");
            
                $(".sub_img dt").removeClass("select");
                $(this).parent().addClass("select");
            
                $(".main_img img").fadeOut(500, function()
                {
                    $(this).attr("src", img),
                    $(this).fadeIn(500)
                });
            });
        });
</script>
<!--------------------------------------------> 

@endsection