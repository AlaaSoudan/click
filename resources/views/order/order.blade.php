<!--begin::Form-->
@extends('layouts.app')
@section('content')
<section class="container">
<div class=" container my-5 row p-8 ">
    <table>

        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
                <span class="fa fa-table">&nbsp;</span>
               طلباتي
            </span>
        </h3>
        <thead>
          @if (!count($orders) == 0)
          <tr>

            <th class="font-weight-bolder text-dark" >إجمالي الفاتورة</th>
            <th>الحالة</th>
            <th>تاريخ الطلب</th>
            <th>  </th>
            <th>     </th>
        </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <td>{{ $order->total_price }}</td>
          <td>{{ app\models\Order::STATUS_ARABIC[$order->status]}}</td>
          <td>{{ $order->created_at}}</td>
          <td> <a class="btn btn-sm btn-clean btn-icon"
                  href="{{ route('order_details', $order->id) }}">
                 تفاصيل الطلب
                  <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
              </a>
          </td>
          <td>

          </td>
          </tr>
      @endforeach

        </tbody>

      </table>
      @else
      <p style="text-align: center"> No Records Found</p>
      @endif


</section>
<style>
          table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
      }

      table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
      }

      table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
      }

      table th,
      table td {
        padding: .625em;
        text-align: center;
      }

      table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
      }

      @media screen and (max-width: 600px) {
        table {
          border: 0;
        }

        table caption {
          font-size: 1.3em;
        }

        table thead {
          border: none;
          clip: rect(0 0 0 0);
          height: 1px;
          margin: -1px;
          overflow: hidden;
          padding: 0;
          position: absolute;
          width: 1px;
        }

        table tr {
          border-bottom: 3px solid #ddd;
          display: block;
          margin-bottom: .625em;
        }

        table td {
          border-bottom: 1px solid #ddd;
          display: block;
          font-size: .8em;
          text-align: right;
        }

        table td::before {
          /*
          * aria-label has no advantage, it won't be read inside a table
          content: attr(aria-label);
          */
          content: attr(data-label);
          float: left;
          font-weight: bold;
          text-transform: uppercase;
        }

        table td:last-child {
          border-bottom: 0;
        }
      }

      /* general styling */
      body {
        font-family: "Open Sans", sans-serif;
        line-height: 1.25;
      }

</style>
@endsection
