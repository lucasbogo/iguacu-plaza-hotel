<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use App\Models\BookedRoom;
use Stripe;

class BookingController extends Controller  
{
    public function cart_submit(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id', // Ensure that the room_id exists in the rooms table
            'checkin_checkout' => 'required',
            'checkin_checkout' => 'required',
            'adult' => 'required'
        ], [
            'room_id.required' => 'Por favor, selecione um quarto para prosseguir com a reserva.',
            'checkin_checkout.required' => 'O campo check-in/check-out é obrigatório.',
            'adult.required' => 'O campo adultos é obrigatório.'
        ]);

        $dates = explode(' - ', $request->checkin_checkout);
        $checkin_date = $dates[0];
        $checkout_date = $dates[1];

        $d1 = explode('/', $checkin_date);
        $d2 = explode('/', $checkout_date);
        $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
        $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];
        $t1 = strtotime($d1_new);
        $t2 = strtotime($d2_new);

        $cnt = 1;
        while (1) {
            if ($t1 >= $t2) {
                break;
            }
            $single_date = date('d/m/Y', $t1);
            $total_already_booked_rooms = BookedRoom::where('booking_date', $single_date)->where('room_id', $request->room_id)->count();

            $arr = Room::where('id', $request->room_id)->first();
            $total_allowed_rooms = $arr->total_rooms;

            if ($total_already_booked_rooms == $total_allowed_rooms) {
                $cnt = 0;
                break;
            }
            $t1 = strtotime('+1 day', $t1);
        }

        if ($cnt == 0) {
            return redirect()->back()->with('error', 'Número máximo deste quarto já está reservado');
        }

        session()->push('cart_room_id', $request->room_id);
        session()->push('cart_checkin_date', $checkin_date);
        session()->push('cart_checkout_date', $checkout_date);
        session()->push('cart_adult', $request->adult);
        session()->push('cart_children', $request->children);

        return redirect()->back()->with('success', 'Quarto adicionado ao carrinho com sucesso.');
    }

    public function cart_view()
    {
        return view('frontend.booking.cart');
    }

    public function cart_delete($id)
    {
        $arr_cart_room_id = array();
        $i = 0;
        foreach (session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i = 0;
        foreach (session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i = 0;
        foreach (session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i = 0;
        foreach (session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i = 0;
        foreach (session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');

        for ($i = 0; $i < count($arr_cart_room_id); $i++) {
            if ($arr_cart_room_id[$i] == $id) {
                continue;
            } else {
                session()->push('cart_room_id', $arr_cart_room_id[$i]);
                session()->push('cart_checkin_date', $arr_cart_checkin_date[$i]);
                session()->push('cart_checkout_date', $arr_cart_checkout_date[$i]);
                session()->push('cart_adult', $arr_cart_adult[$i]);
                session()->push('cart_children', $arr_cart_children[$i]);
            }
        }

        return redirect()->back()->with('success', 'Quarto excluído com sucesso.');
    }

    public function checkout()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Você precisa fazer login para finalizar a compra.');
        }

        if (!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'Não há itens no carrinho.');
        }

        return view('frontend.booking.checkout');
    }

    public function payment(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Você precisa fazer login para finalizar a compra.');
        }

        if (!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'Não há itens no carrinho.');
        }

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_phone' => 'required',
            'billing_country' => 'required',
            'billing_street' => 'required',
            'billing_number' => 'required',
            'billing_state' => 'required',
            'billing_city' => 'required',
            'billing_zip_code' => 'required'
        ]);

        session()->put('billing_name', $request->billing_name);
        session()->put('billing_email', $request->billing_email);
        session()->put('billing_phone', $request->billing_phone);
        session()->put('billing_country', $request->billing_country);
        session()->put('billing_street', $request->billing_street);
        session()->put('billing_number', $request->billing_number);
        session()->put('billing_state', $request->billing_state);
        session()->put('billing_city', $request->billing_city);
        session()->put('billing_zip_code', $request->billing_zip_code);

        return view('frontend.booking.payment');
    }

    public function stripe(Request $request, $final_price)
    {
        $stripe_secret_key = 'sk_test_51OMfk0LM0jg28WdRMjWhgolMWJppoAI5SngBZs7zWlR0ztTrCBE8uGtf4XB8dmD98IOh5IpbwMyCj4eEDIxpewJ800kAtoOCiX';
        $cents = $final_price * 100;
        Stripe\Stripe::setApiKey($stripe_secret_key);
        $response = Stripe\Charge::create([
            "amount" => $cents,
            "currency" => "brl",
            "source" => $request->stripeToken,
            "description" => env('APP_NAME')
        ]);

        $responseJson = $response->jsonSerialize();
        $transaction_id = $responseJson['balance_transaction'];
        $last_4 = $responseJson['payment_method_details']['card']['last4'];

        $order_no = time();

        // Save the order
        $order = new Order();
        $order->customer_id = Auth::guard('customer')->user()->id;
        $order->order_no = $order_no;
        $order->transaction_id = $transaction_id;
        $order->payment_method = 'Stripe';
        $order->card_last_digit = $last_4;
        $order->paid_amount = $final_price;
        $order->booking_date = date('d/m/Y');
        $order->status = 'Completed';
        $order->save();

        // Retrieve the auto-incremented ID
        $ai_id = $order->id;

        // Process order details
        $arr_cart_room_id = session()->get('cart_room_id', []);
        $arr_cart_checkin_date = session()->get('cart_checkin_date', []);
        $arr_cart_checkout_date = session()->get('cart_checkout_date', []);
        $arr_cart_adult = session()->get('cart_adult', []);
        $arr_cart_children = session()->get('cart_children', []);

        foreach ($arr_cart_room_id as $i => $room_id) {
            $r_info = Room::find($room_id);
            $d1 = explode('/', $arr_cart_checkin_date[$i]);
            $d2 = explode('/', $arr_cart_checkout_date[$i]);
            $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
            $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];
            $t1 = strtotime($d1_new);
            $t2 = strtotime($d2_new);
            $diff = ($t2 - $t1) / 60 / 60 / 24;
            $sub = $r_info->price * $diff;

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $ai_id;
            $orderDetail->room_id = $room_id;
            $orderDetail->order_no = $order_no;
            $orderDetail->checkin_date = $arr_cart_checkin_date[$i];
            $orderDetail->checkout_date = $arr_cart_checkout_date[$i];
            $orderDetail->adult = $arr_cart_adult[$i];
            $orderDetail->children = $arr_cart_children[$i];
            $orderDetail->subtotal = $sub;
            $orderDetail->save();


            while (1) {
                if ($t1 >= $t2) {
                    break;
                }

                $obj = new BookedRoom();
                $obj->booking_date = date('d/m/Y', $t1);
                $obj->order_no = $order_no;
                $obj->room_id = $arr_cart_room_id[$i];
                $obj->save();

                $t1 = strtotime('+1 day', $t1);
            }
        }

        $subject = 'Nova Reserva';
        $message = 'Você acabou de efetuar uma reserva no Iguaçu Plaza Hotel. Seguem as informações da sua reserva: <br>';
        $message .= '<br>Número da Reserva: ' . $order_no;
        $message .= '<br>Número da transação: ' . $transaction_id;
        $message .= '<br>Método de Pagamento: Cartão';
        $message .= '<br>Total: ' . $final_price;
        $message .= '<br>Data da Reserva: ' . date('d/m/Y') . '<br>';

        for ($i = 0; $i < count($arr_cart_room_id); $i++) {

            $r_info = Room::where('id', $arr_cart_room_id[$i])->first();

            $message .= '<br>Tipo de quarto: ' . $r_info->name;
            $message .= '<br>Valor da Diária: R$' . $r_info->price;
            $message .= '<br>Checkin: ' . $arr_cart_checkin_date[$i];
            $message .= '<br>Checkout: ' . $arr_cart_checkout_date[$i];
            $message .= '<br>Adultos: ' . $arr_cart_adult[$i];
            $message .= '<br>Crianças: ' . $arr_cart_children[$i] . '<br>';
        }

        $customer_email = Auth::guard('customer')->user()->email;

        Mail::to($customer_email)->send(new Websitemail($subject, $message));

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');
        session()->forget('billing_name');
        session()->forget('billing_email');
        session()->forget('billing_phone');
        session()->forget('billing_country');
        session()->forget('billing_address');
        session()->forget('billing_state');
        session()->forget('billing_city');
        session()->forget('billing_zip');

        return redirect()->route('home')->with('success', 'Pagamento efutado com sucesso! A sua reserva esstá garantida.');
    }
}
