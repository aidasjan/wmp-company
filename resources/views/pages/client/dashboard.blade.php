@extends('layouts.app')

@section('content')
    <div class='container'>

        <div class='row py-5'>
            <div class='col'>
                <h5>{{auth()->user()->name}} | {{auth()->user()->email}}</h5>
                <h1 class='text-uppercase'>{{ __('main.dashboard') }}</h1>
            </div>
        </div>

        <div class='row py-3'>
            <div class='col py-4 mx-3 dashboard_box container_lightblue'>
                <h3>{{ __('main.make_order') }}</h3>
                <span>{{ __('main.make_order_desc') }}</span>
                <form action="{{ action('App\Http\Controllers\OrdersController@store') }}" method='POST'>
                    {{csrf_field()}}
                    <button type='submit' class='btn btn-primary mt-4 mb-3 text-uppercase' href='#'>{{ __('main.new_order') }}</button>
                </form>
            </div>
        </div>

        <div class='row'>

            <div class='col-md mx-3'>

                <div class='row py-4'>
                    <div class='col py-2 dashboard_box container_lightblue'>
                        <div class='row'>
                            <div class='col text-left py-3'>
                                <h3>{{ __('main.unsubmitted_orders') }}</h3>
                                <span>{{ __('main.unsubmitted_orders_desc') }}</span>
                            </div>
                            <div class='col text-right py-3'>
                                <a class='btn btn-primary text-uppercase' href="{{url('/orders/status/0')}}">{{ __('main.view_all') }}</a>
                            </div>
                        </div>

                        <div class='row py-3'>
                            <div class='col'>
                                @if (count($unsubmittedOrders) > 0)
                                <table class='table table_main'>
                                    <?php $counter = 1 ?>
                                    <tr><th></th><th>{{ __('main.order') }}</th><th>{{ __('main.date') }}</th></tr>
                                    @foreach ($unsubmittedOrders as $order)
                                        <tr>
                                            <td>{{$counter++}}.</td>
                                            <td><a href="{{url('/orders'.'/'.$order->id)}}" class='text-uppercase'>{{ __('main.order') }} {{$order->id}}</td>
                                            <td>{{$order->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                @else
                                <h5>{{ __('main.no_orders') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row py-4'>
                    <div class='col py-2 dashboard_box container_lightblue'>
                        <div class='row'>
                            <div class='col text-left py-3'>
                                <h3>{{ __('main.submitted_orders') }}</h3>
                                <span>{{ __('main.submitted_orders_desc') }}</span>
                            </div>
                            <div class='col text-right py-3'>
                                <a class='btn btn-primary text-uppercase' href="{{url('/orders/status/1')}}">{{ __('main.view_all') }}</a>
                            </div>
                        </div>

                        <div class='row py-3'>
                            <div class='col'>
                                @if (count($submittedOrders) > 0)
                                <table class='table table_main'>
                                    <?php $counter = 1 ?>
                                    <tr><th></th><th>{{ __('main.order') }}</th><th>{{ __('main.date') }}</th></tr>
                                    @foreach ($submittedOrders as $order)
                                        <tr>
                                            <td>{{$counter++}}.</td>
                                            <td><a href="{{url('/orders'.'/'.$order->id)}}" class='text-uppercase'>{{ __('main.order') }} {{$order->id}}</td>
                                            <td>{{$order->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                @else
                                <h5>{{ __('main.no_orders') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class='col-md mx-3'>

                <div class='row py-4'>
                    <div class='col py-2 dashboard_box container_lightblue'>
                        <div class='row'>
                            <div class='col text-left py-3'>
                                <h3>{{ __('main.confirmed_orders') }}</h3>
                                <span>{{ __('main.confirmed_orders_desc') }}</span>
                            </div>
                            <div class='col text-right py-3'>
                                <a class='btn btn-primary text-uppercase' href="{{url('/orders/status/2')}}">{{ __('main.view_all') }}</a>
                            </div>
                        </div>

                        <div class='row py-3'>
                            <div class='col'>
                                @if (count($confirmedOrders) > 0)
                                <table class='table table_main'>
                                    <?php $counter = 1 ?>
                                    <tr><th></th><th>{{ __('main.order') }}</th><th>{{ __('main.date') }}</th></tr>
                                    @foreach ($confirmedOrders as $order)
                                        <tr>
                                            <td>{{$counter++}}.</td>
                                            <td><a href="{{url('/orders'.'/'.$order->id)}}" class='text-uppercase'>{{ __('main.order') }} {{$order->id}}</td>
                                            <td>{{$order->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                @else
                                <h5>{{ __('main.no_orders') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class='row py-4'>
                    <div class='col py-2 dashboard_box container_lightblue'>
                        <div class='row'>
                            <div class='col text-left py-3'>
                                <h3>{{ __('main.my_discounts') }}</h3>
                                <span>{{ __('main.my_discounts_desc') }}</span>
                            </div>
                            <div class='col text-right py-3'>
                                <a class='btn btn-primary text-uppercase' href="{{url('/discounts')}}">{{ __('main.view_all') }}</a>
                            </div>
                        </div>

                        <div class='row py-3'>
                            <div class='col'>
                                @if (count($discounts) > 0)
                                <table class='table table_main'>
                                    <?php $counter = 1 ?>
                                    <tr><th></th><th>{{ __('main.category') }}</th><th>{{ __('main.discount') }}</th></tr>
                                    @foreach ($discounts as $discount)
                                        <tr>
                                            <td>{{$counter++}}.</td>
                                            <td><a href="{{url($discount->category->getDisplayUrl())}}">{{$discount->category->name}}</td>
                                            <td>{{$discount->discount}}%</td>
                                        </tr>
                                    @endforeach
                                </table>
                                @else
                                <h5>{{ __('main.no_discounts') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection