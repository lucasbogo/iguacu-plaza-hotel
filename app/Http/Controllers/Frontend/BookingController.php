<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function cart_submit(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'checkin_checkout' => 'required',
            'adult' => 'required'
        ], [
            'room_id.required' => 'O campo quarto é obrigatório.',
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

        // $cnt = 1;
        // while (1) {
        //     if ($t1 >= $t2) {
        //         break;
        //     }
        //     $single_date = date('d/m/Y', $t1);
        //     // $total_already_booked_rooms = BookedRoom::where('booking_date', $single_date)->where('room_id', $request->room_id)->count();

        //     $arr = Room::where('id', $request->room_id)->first();
        //     $total_allowed_rooms = $arr->total_rooms;

        //     if ($total_already_booked_rooms == $total_allowed_rooms) {
        //         $cnt = 0;
        //         break;
        //     }
        //     $t1 = strtotime('+1 day', $t1);
        // }

        // if ($cnt == 0) {
        //     return redirect()->back()->with('error', 'Número máximo deste quarto já está reservado');
        // }

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
}