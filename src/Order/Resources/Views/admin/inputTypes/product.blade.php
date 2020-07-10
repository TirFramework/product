<?php
$order = $item;
?>

<div class="col-12">

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>{{ trans('order::orders.product') }}</th>
                <th>{{ trans('order::orders.unit_price') }}</th>
                <th>{{ trans('order::orders.quantity') }}</th>
                <th>{{ trans('order::orders.line_total') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($order->products as $product)
                <tr>
                    <td>
                        @if ($product->trashed())
                            {{ $product->name }}
                        @else
                            <a href="{{ route('product.edit', $product->product->id) }}">{{ $product->name }}</a>
                        @endif

                        @if ($product->hasAnyOption())
                            <br>
                            @foreach ($product->options as $option)
                                <span>
                                {{ $option->name }}:
                                <span>{{ $option->values->implode('label', ', ') }}</span>
                            </span>
                            @endforeach
                        @endif
                    </td>

                    <td>
                        {{ $product->unit_price->format($order->currency) }}
                    </td>

                    <td>{{ $product->qty }}</td>

                    <td>
                        {{ $product->line_total->format($order->currency) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>



        <div class="order-totals">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>{{ trans('order::orders.subtotal') }}</td>
                        <td class="text-right">{{ $order->sub_total->format($order->currency) }}</td>
                    </tr>

                    @if ($order->hasShippingMethod())
                        <tr>
                            <td>{{ $order->shipping_method }}</td>
                            <td class="text-right">{{ $order->shipping_cost->format($order->currency) }}</td>
                        </tr>
                    @endif

                    @if ($order->hasCoupon())
                        <tr>
                            <td>{{ trans('order::orders.coupon') }} (<span class="coupon-code">{{ $order->coupon->code }}</span>)</td>
                            <td class="text-right">&#8211;{{ $order->discount->format($order->currency) }}</td>
                        </tr>
                    @endif

                    @foreach ($order->taxes as $tax)
                        <tr>
                            <td>{{ $tax->name }}</td>
                            <td class="text-right">{{ $tax->order_tax->amount->format($order->currency) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>{{ trans('order::orders.total') }}</td>
                        <td class="text-right">{{ $order->total->format($order->currency) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
