@extends("layout")

@section('title',"Cart")

@section('content')
<div class="container-fluid">
                <div class="row">
                	
                    <div class="col-12 col-lg-8">
                    	<div class="mb-10">
                    	    <p class="text-success">Why stop now?</p>
                            <a href="{{url('top-deals')}}" class="btn amado-btn w-100">Continue shopping</a>
                        </div>
                    	<form action="{{url('update-cart')}}" method="post">
                	      {!! csrf_field() !!}
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                    	<th></th>
                                        <th>Deal</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@if(count($cart)  > 0)
                                    @foreach($cart as $c) 
                                    <?php
                                    $vid = "qty-".$c['id'];
                                     $deal = $c['deal'];
                                     if(count($deal) < 1){
                                   	$amount = 0;
                                       $qty = 0;
                                       $du = "#";
                                       $deal = ['name' => "<s>Deleted</s>",
                                                   'data' => ['amount'=> 0]
                                          ];
                                       $imgg = "https://via.placeholder.com/150";
                                       $removeURL = url('remove-from-cart').'?asf='.$c['id'];
                                     }
                                     else{
                                        $data = $deal['data'];
                                        $pay = $data['amount'];
                                        
                                        if($c['type'] == "auction"){
                                        	$b = $c['bid'];
                                            if($b != null){
                                            	$pay = $b->pay;
                                            }
                                        }
                                        $images = $deal['images'];
                                        shuffle($images);
                                        $ird = $images[0]['url'];
                                        $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;
                                        $du = url('deal')."?sku=".$deal['sku'];
                                        $removeURL = url('remove-from-cart').'?asf='.$deal['sku'];
                                        }
                                    ?>
                                    <tr>
                                        <td class="cart_product_img">
                                            <center>
                                <img src="{{$imgg}}" class="img img-fluid cli" style="width: 40% !important;" data-cli="{{$du}}" alt="">
                                
                                </center><br>
                                	
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5><a href="{{$du}}">{{$deal['name']}}</a></h5>
                                        </td>
                                        <td class="price">
                                            <span>&#8358;{{number_format($pay,2)}}</span>
                                        </td>
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <p>Qty</p>
                                                <div class="quantity">
                                                    <span class="qty-minus" onclick="var effect = document.getElementById('{{$vid}}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                    <input type="number" class="qty-text" id="{{$vid}}" step="1" min="1" max="300" name="quantity[]" value="{{$c['qty']}}">
                                                    <span class="qty-plus" onclick="var effect = document.getElementById('{{$vid}}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price">
                                            <a href="{{$removeURL}}" class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <center><button type="submit" class="btn btn-success">Update cart</button></center>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                     </form> 
                    </div>
                    
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <?php
                                     $subtotal = $cartTotals['subtotal'];
                                     $delivery = $cartTotals['delivery'];
                                     $total = $cartTotals['total'];
                                    ?>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>&#8358;{{number_format($subtotal,2)}}</span></li>
                                <li><span>delivery:</span> <span>&#8358;{{number_format($delivery,2)}}</span></li>
                                <li><span>total:</span> <span>&#8358;{{number_format($total,2)}}</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="{{url('checkout')}}" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
             </div>             
@stop