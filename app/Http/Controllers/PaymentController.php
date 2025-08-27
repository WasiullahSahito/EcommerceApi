<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $order = Order::where('user_id', auth()->id())->find($request->order_id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->status === 'cancelled') {
            return response()->json(['message' => 'Cannot pay for a cancelled order'], 400);
        }

        if ($order->payment()->exists()) {
            $payment = $order->payment;
            if ($payment->status === 'completed') {
                return response()->json(['message' => 'Order already paid'], 400);
            }
        }

        // Mock payment processing
        $success = $this->mockPaymentGateway();

        $payment = Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'amount' => $order->total_amount,
                'payment_method' => $request->payment_method,
                'status' => $success ? 'completed' : 'failed',
                'transaction_id' => $success ? 'TXN_' . uniqid() : null,
            ]
        );

        if ($success) {
            $order->status = 'processing';
            $order->save();

            return response()->json([
                'message' => 'Payment successful',
                'payment' => $payment
            ]);
        } else {
            return response()->json([
                'message' => 'Payment failed',
                'payment' => $payment
            ], 400);
        }
    }

    public function refund(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($payment->status !== 'completed') {
            return response()->json(['message' => 'Only completed payments can be refunded'], 400);
        }

        // Mock refund processing
        $success = $this->mockRefundGateway();

        if ($success) {
            $payment->status = 'refunded';
            $payment->save();

            $order = $payment->order;
            $order->status = 'cancelled';
            $order->save();

            return response()->json([
                'message' => 'Refund processed successfully',
                'payment' => $payment
            ]);
        } else {
            return response()->json([
                'message' => 'Refund failed',
                'payment' => $payment
            ], 400);
        }
    }

    private function mockPaymentGateway()
    {
        // Simulate payment success (80% success rate)
        return rand(1, 100) <= 80;
    }

    private function mockRefundGateway()
    {
        // Simulate refund success (90% success rate)
        return rand(1, 100) <= 90;
    }
}
