@extends('dashboard')

@section('main_content')
    <div class="product_content">
        <h1 style="text-align: center; padding-top: 5%; margin-bottom: 30px;">Створення нової позициї</h1>
        <div class="form_create_product">
            <form action="{{route('create_pr')}}" method="post" >
                @csrf
                <label for="name" >Name</label><br>
                <input  type="text" name="name" @error('name')style="border: 1px solid orangered"@enderror ><br><br>
                <label for="brand" >Brand</label><br>
                <input type="text" list="brand" name="brand" @error('brand')style="border: 1px solid orangered"@enderror />
                <datalist id="brand" >
                    <option >AE</option><option >ABS</option>
                    <option >BOSCH</option><option >AJUSA</option>
                    <option >FERODO</option><option >CS</option>
                    <option >BERU</option><option >CHAMPION</option>
                    <option >FAG</option><option >GATES</option>
                    <option >DELPHI</option><option >DENSO</option>
                </datalist><br><br>
                <label for="code" >Code (Catalog number)</label><br>
                <input  type="text" name="code" @error('code')style="border: 1px solid orangered"@enderror><br><br>
                <label for="price" >Price</label><br>
                <input  type="number" name="price" min="50" @error('price')style="border: 1px solid orangered"@enderror ><br><br>
                <label for="quantity" >Quantity</label><br>
                <input  type="number" name="qty" min="0"  @error('qty')style="border: 1px solid orangered"@enderror ><br><br>
                <label for="able" >Active (1,0)</label><br>
                <input  type="text" name="able" @error('able')style="border: 1px solid orangered"@enderror ><br><br>
                <button type="submit" class="buy_button_confirm">Підтвердити</button>
            </form>
            <a href="{{route('user')}}"><button type="submit" class="buy_button_back">Назад</button></a>
        </div>
    </div>
@endsection
