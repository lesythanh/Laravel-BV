<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .center-text {
      width: 40%;
      text-align: center;
    }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 10px;
    }
  </style>
  <title>Shop ABC</title>
</head>
<body>
  <div class="center-text">
    <h2>SHOP ABC</h2>
    <p>Thông báo xác nhận đơn hàng</p>
  </div>
  <p>Xin chào!</p>
  <div class="content">
    <table>
      <thead>
        <tr>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Into money</th>
      </tr>
      <tbody>
        @foreach($data['cart'] as $product)
          <tr>
            <td>{{$product['name']}}</td>
            <td>{{$product['qty']}}</td>
            <td>{{$product['price']}}</td>
            <td>{{$product['qty'] * $product['price']}}$</td>
          </tr>
        @endforeach
        <tr>
          <td colspan="3">Total money</td>
          <td>{{$data['total']}}</td>
        </tr>
      </tbody>
    </thead>
    </table>
  </div>
</body>
</html>