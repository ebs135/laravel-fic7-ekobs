<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
  public function callback()
  {
    $callback = new CallbackService;

    if ($callback->isSignatureKeyVerified()) {
      $notification = $callback->getNotification();
      $order = $callback->getOrder();

      if ($callback->isSuccess()) {
        Order::where('id', $order->id)->update([
          'payment_status' => 'complete',
        ]);
      }

      if ($callback->isExpire()) {
        Order::where('id', $order->id)->update([
          'payment_status' => 'expired',
        ]);
      }

      if ($callback->isCancelled()) {
        Order::where('id', $order->id)->update([
          'payment_status' => 'canceled',
        ]);
      }

      return response()
        ->json([
          'success' => true,
          'message' => 'Notifikasi berhasil diproses',
        ]);
    } else {
      return response()
        ->json([
          'error' => true,
          'message' => 'Signature key tidak terverifikasi',
        ], 403);
    }
  }
}
