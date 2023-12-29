@extends('customer.layout.master')

@section('heading', 'Reserva')

@section('main_content')
    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Detalhes da Reserva</h2>
                            <div class="invoice-number">Numero da Reserva #{{ $order->order_no }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Dados do cliente</strong><br>
                                    @if (session()->has('billing_name'))
                                        {{ session('billing_name') }}<br>
                                        {{ session('billing_phone') }},<br>
                                        {{ session('billing_street') }},
                                        {{ session('billing_number') }},
                                        {{ session('billing_city') }},
                                        {{ session('billing_state') }},
                                        {{ session('billing_zip_code') }},
                                        {{ session('billing_country') }}.
                                    @else
                                        {{ Auth::guard('customer')->user()->name }}<br>
                                        {{ Auth::guard('customer')->user()->phone }},<br>
                                        {{ Auth::guard('customer')->user()->street }},
                                        {{ Auth::guard('customer')->user()->number }},
                                        {{ Auth::guard('customer')->user()->city }},
                                        {{ Auth::guard('customer')->user()->state }},
                                        {{ Auth::guard('customer')->user()->zip_code }},
                                        {{ Auth::guard('customer')->user()->country }}.
                                    @endif
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Data da Reserva</strong><br>
                                    {{ $order->booking_date }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Resumo do Pedido</div>
                        <p class="section-lead">As informações sobre os quartos do hotel estão detalhadas abaixo:</p>
                        <hr class="invoice-above-table">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th>SL</th>
                                    <th>Tipo do Quarto Reservado</th>
                                    <th class="text-center">Checkin</th>
                                    <th class="text-center">Checkout</th>
                                    <th class="text-center">Adultos</th>
                                    <th class="text-center">Crianças</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                                @php $total = 0; @endphp
                                @foreach ($order_detail as $item)
                                    @php
                                        $room_data = \App\Models\Room::where('id', $item->room_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $room_data->name }}</td>
                                        <td class="text-center">{{ $item->checkin_date }}</td>
                                        <td class="text-center">{{ $item->checkout_date }}</td>
                                        <td class="text-center">{{ $item->adult }}</td>
                                        <td class="text-center">{{ $item->children }}</td>
                                        <td class="text-right">
                                            @php
                                                $d1 = explode('/', $item->checkin_date);
                                                $d2 = explode('/', $item->checkout_date);
                                                $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
                                                $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];
                                                $t1 = strtotime($d1_new);
                                                $t2 = strtotime($d2_new);
                                                $diff = ($t2 - $t1) / 60 / 60 / 24;
                                                $sub = $room_data->price * $diff;
                                            @endphp
                                            R${{ $sub }}
                                        </td>
                                    </tr>
                                    @php
                                        $total += $sub;
                                    @endphp
                                @endforeach
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">R${{ $total }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="about-print-button">
            <div class="text-md-right">
                <a href="javascript:window.print();"
                    class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fa fa-print"></i>
                    Imprimir</a>
            </div>
        </div>
    </div>
@endsection
