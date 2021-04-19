@extends('dashboard')

@section('main_content')
    <div class="product_setting_content">
        @foreach($products as $product)
            @if($product->id==request()->id)
                <h1 style="text-align: center; padding-top: 5%; margin-bottom: 30px;">Зміна параметрів </h1>
                <div class="form_create_product">
                    <form action="{{route('product.update')}}" method="post" >
                        @csrf
                        <label for="name" >Name</label><br>
                        <input  type="text" name="name" @error('name')style="border: 1px solid orangered"@enderror  value="{{$product->name}}"><br><br>
                        <label for="brand" >Brand</label><br>
                        <input type="text" list="brand" name="brand" @error('brand')style="border: 1px solid orangered"@enderror value="{{$product->brand}}"/><br><br>
                        <label for="code" >Code (Catalog number)</label><br>
                        <input  type="text" name="code" @error('code')style="border: 1px solid orangered"@enderror value="{{$product->code}}"><br><br>
                        <label for="price" >Price</label><br>
                        <input  type="number" name="price" min="50" @error('price')style="border: 1px solid orangered"@enderror value="{{$product->price}}"><br><br>
                        <label for="quantity" >Quantity</label><br>
                        <input  type="number" name="qty" min="0"  @error('qty')style="border: 1px solid orangered"@enderror value="{{$product->qty}}"><br><br>
                        <label for="able" >Active (1,0)</label><br>
                        <input  type="text" name="able" @error('able')style="border: 1px solid orangered"@enderror value="{{$product->able}}"><br><br>
                        <input  type="hidden" name="id"  value="{{$product->id}}">
                        <button type="submit" class="buy_button_confirm">Оновити</button>
                    </form>
                    <form action="{{route('page.product')}}" method="GET">
                        <input type="hidden" name="id" value="{{$product->id}}"/>
                        <button type="submit" class="buy_button_back">Назад</button>
                    </form>

                </div>
            @endif
        @endforeach
    </div>
@endsection
