@extends('frontend.layout.master')

@section('main_content')

{{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> --}}

<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page->payment_heading }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 checkout-left mb_30">


                @php
                $arr_cart_room_id = array();
                $i=0;
                foreach(session()->get('cart_room_id') as $value) {
                    $arr_cart_room_id[$i] = $value;
                    $i++;
                }
                $arr_cart_checkin_date = array();
                $i=0;
                foreach(session()->get('cart_checkin_date') as $value) {
                    $arr_cart_checkin_date[$i] = $value;
                    $i++;
                }
                $arr_cart_checkout_date = array();
                $i=0;
                foreach(session()->get('cart_checkout_date') as $value) {
                    $arr_cart_checkout_date[$i] = $value;
                    $i++;
                }
                $arr_cart_adult = array();
                $i=0;
                foreach(session()->get('cart_adult') as $value) {
                    $arr_cart_adult[$i] = $value;
                    $i++;
                }
                $arr_cart_children = array();
                $i=0;
                foreach(session()->get('cart_children') as $value) {
                    $arr_cart_children[$i] = $value;
                    $i++;
                }
                $total_price = 0;
                for($i=0;$i<count($arr_cart_room_id);$i++)
                {
                    $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();                            
                    $d1 = explode('/',$arr_cart_checkin_date[$i]);
                    $d2 = explode('/',$arr_cart_checkout_date[$i]);
                    $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                    $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                    $t1 = strtotime($d1_new);
                    $t2 = strtotime($d2_new);
                    $diff = ($t2-$t1)/60/60/24;
                    $total_price = $total_price+($room_data->price*$diff);
                }
                @endphp
                        
                <h4>Efetuar Pagamento</h4>
                <select name="payment_method" class="form-control select2" id="paymentMethodChange" autocomplete="off">
                    <option value="">Selecionar Método de Pagamento</option>
                    <option value="Stripe">Cartão de Crédito/Débito</option>
                </select>
                
                {{-- <div class="paypal mt_20">
                    <h4>Pagar com PayPal</h4>
                    <div id="paypal-button"></div>
                </div> --}}

                <div class="stripe mt_20">
                    <h4>Pagar com Cartão</h4>
                    @php
                    $cents = $total_price*100;
                    $customer_email = Auth::guard('customer')->user()->email;
                    $stripe_publishable_key = 'pk_test_51OMfk0LM0jg28WdRMtwehJaiO6qTKdBJtSkpa9dO5YKkHRIz8uxsYO1S7SDwf7s5jFoGqbku2ttPrzBxndnFmUN300xOmKgDqM';
                    @endphp
                    <form action="{{ route('stripe',$total_price) }}" method="post">
                        @csrf
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ $stripe_publishable_key }}"
                            data-amount="{{ $cents }}"
                            data-name="{{ env('APP_NAME') }}"
                            data-description=""
                            data-image="{{ asset('stripe.png') }}"
                            data-currency="brl"
                            data-email="{{ $customer_email }}"
                        >
                        </script>
                    </form> 
                </div>

            </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Detalhes do Pagamento</h4>
                    <div>
                        Nome: {{ session()->get('billing_name') }}
                    </div>
                    <div>
                        E-mail: {{ session()->get('billing_email') }}
                    </div>
                    <div>
                        Telefone: {{ session()->get('billing_phone') }}
                    </div>
                    <div>
                        País: {{ session()->get('billing_country') }}
                    </div>
                    <div>
                        Rua: {{ session()->get('billing_street') }}
                    </div>
                    <div>
                        Numero: {{ session()->get('billing_number') }}
                    </div>
                    <div>
                        Estado: {{ session()->get('billing_state') }}
                    </div>
                    <div>
                        Cidade: {{ session()->get('billing_city') }}
                    </div>
                    <div>
                        CEP: {{ session()->get('billing_zip_code') }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Detalhes da Reserva</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @php
                                $arr_cart_room_id = array();
                                $i=0;
                                foreach(session()->get('cart_room_id') as $value) {
                                    $arr_cart_room_id[$i] = $value;
                                    $i++;
                                }

                                $arr_cart_checkin_date = array();
                                $i=0;
                                foreach(session()->get('cart_checkin_date') as $value) {
                                    $arr_cart_checkin_date[$i] = $value;
                                    $i++;
                                }

                                $arr_cart_checkout_date = array();
                                $i=0;
                                foreach(session()->get('cart_checkout_date') as $value) {
                                    $arr_cart_checkout_date[$i] = $value;
                                    $i++;
                                }

                                $arr_cart_adult = array();
                                $i=0;
                                foreach(session()->get('cart_adult') as $value) {
                                    $arr_cart_adult[$i] = $value;
                                    $i++;
                                }

                                $arr_cart_children = array();
                                $i=0;
                                foreach(session()->get('cart_children') as $value) {
                                    $arr_cart_children[$i] = $value;
                                    $i++;
                                }

                                $total_price = 0;
                                for($i=0;$i<count($arr_cart_room_id);$i++)
                                {
                                    $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ $room_data->name }}
                                            <br>
                                            ({{ $arr_cart_checkin_date[$i] }} - {{ $arr_cart_checkout_date[$i] }})
                                            <br>
                                            Adult: {{ $arr_cart_adult[$i] }}, Children: {{ $arr_cart_children[$i] }}
                                        </td>
                                        <td class="p_price">
                                            @php
                                                $d1 = explode('/',$arr_cart_checkin_date[$i]);
                                                $d2 = explode('/',$arr_cart_checkout_date[$i]);
                                                $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                                                $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                                                $t1 = strtotime($d1_new);
                                                $t2 = strtotime($d2_new);
                                                $diff = ($t2-$t1)/60/60/24;
                                                echo '$'.$room_data->price*$diff;
                                            @endphp
                                        </td>
                                    </tr>
                                    @php
                                    $total_price = $total_price+($room_data->price*$diff);
                                }
                                @endphp                                
                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>R${{ $total_price }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @php
$client = 'ARw2VtkTvo3aT7DILgPWeSUPjMK_AS5RlMKkUmB78O8rFCJcfX6jFSmTDpgdV3bOFLG2WE-s11AcCGTD';
@endphp
<script>
	paypal.Button.render({
		env: 'sandbox',
		client: {
			sandbox: '{{ $client }}',
			production: '{{ $client }}'
		},
		locale: 'en_US',
		style: {
			size: 'medium',
			color: 'blue',
			shape: 'rect',
		},
		// Set up a payment
		payment: function (data, actions) {
			return actions.payment.create({
				redirect_urls:{
					return_url: '{{ url("payment/paypal/$total_price") }}'
				},
				transactions: [{
					amount: {
						total: '{{ $total_price }}',
						currency: 'USD'
					}
				}]
			});
		},
		// Execute the payment
		onAuthorize: function (data, actions) {
			return actions.redirect();
		}
	}, '#paypal-button');
</script> --}}
@endsection