<div>
    <style>
        /* .quantity{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        } */
        .cart-inc-dec{
            min-width: 100px;
            max-width: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            /* padding: 10px; */
            /* margin: 20px 0; */
             /* border-radius: 5px; */
            /* border: 1px solid #ccc;  */
            /* box-shadow: 2px 2px 8px rgba(0,0,0,.5); */
        }
        .cart-inc-dec .qtybutton{
            width: 37px;
            height: 37px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
        }
        .cart-inc-dec input{
            height: 37px;
            width: 60px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin: 0 2px;
        }
    </style>
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li class="active">Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Shopping Cart Area Strat-->
            <div class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">remove</th>
                                                <th class="li-product-thumbnail">images</th>
                                                <th class="cart-product-name">Product</th>
                                                <th class="li-product-price">Unit Price</th>
                                                <th class="li-product-quantity">Quantity</th>
                                                <th class="li-product-subtotal">Total</th>
                                            </tr>
                                        </thead>
                                        @if(Session::has('success_message'))
                                            <div class="alert alert-success">
                                                <strong>Success</strong> {{Session::get('success_message')}}
                                            </div>
                                        @endif
                                        
                                        <tbody>
                                        @if(Cart::content()->count() > 0)
                                            @foreach(Cart::content() as $item)
                                            <tr>
                                                <td class="li-product-remove"><a href="#" wire:click.prevent="destroy('{{ $item->rowId }}')"><i class="fa fa-times"></i></a></td>
                                                <td class="li-product-thumbnail"><a href="{{ route('product.details',['slug'=>$item->model->slug])}}"><img src="{{ asset('images/product/small-size') }}/{{ $item->model->image }}" alt="{{ $item->model->name}}"></a></td>
                                                <td class="li-product-name"><a href="{{ route('product.details',['slug'=>$item->model->slug])}}">{{ $item->model->name}}</a></td>
                                                <td class="li-product-price"><span class="amount">${{ $item->model->regular_price}}</span></td>
                                                <td class="quantity">
                                                    <!-- <label>Quantity</label> -->
                                                    <div class="cart-plus-minus1 cart-inc-dec">
                                                        
                                                        <!-- <input class="cart-plus-minus-box" value="{{ $item->qty }}" type="text"> -->
                                                        <!-- <a href="#" wire:click.prevent="decreaseQuantity('{{ $item->rowId}}')"><div class="dec qtybutton"><i class="fa fa-angle-down"></i></div></a> -->
                                                        <!-- <a href="#" wire:click.prevent="increaseQuantity('{{ $item->rowId}}')"><div class="inc qtybutton"><i class="fa fa-angle-up"></i></div></a> -->
                                                        <input class="cart-plus-minus-box" value="{{ $item->qty }}" type="text">  
                                                        <a href="#" wire:click.prevent="decreaseQuantity('{{ $item->rowId}}')"><div class="dec qtybutton btn btn-info">-</div></a>                                                                                                              
                                                        <a href="#" wire:click.prevent="increaseQuantity('{{ $item->rowId}}')"><div class="inc qtybutton btn btn-info">+</div></a>
                                                        
                                                        
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount">${{ $item->subtotal }}</span></td>
                                            </tr>
                                            @endforeach         
                                        @else
                                            <div class="text-center" style="padding: 30px 0;">
                                                <h1>Your cart is empty!</h1>
                                                <p>Add items to it now</p>
                                                <a href="/shop" class="btn btn-success">Shop Now</a>
                                            </div>
                                        @endif                                            
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon">
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                            </div>
                                            <div class="coupon2">
                                                <input class="button" name="update_cart" value="Update cart" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Cart totals</h2>
                                            <ul>
                                                <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                                                <li>Tax <span>${{ Cart::tax() }}</span></li>
                                                <li>Total <span>${{ Cart::total() }}</span></li>
                                            </ul>
                                            <a href="/checkout">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Shopping Cart Area End-->
</div>