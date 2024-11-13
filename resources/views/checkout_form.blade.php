<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج الدفع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center bg-primary text-white">
            <h4>نموذج إدخال بيانات الدفع</h4>
        </div>
        <div class="card-body">
            <form id="paymentForm" action="{{route('payment.process')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="invoiceValue" class="form-label">قيمة الفاتورة</label>
                    <input type="number" class="form-control" id="invoiceValue" name="InvoiceValue" placeholder="أدخل قيمة الفاتورة" required>
                </div>
                <div class="mb-3">
                    <label for="currency" class="form-label">عملة الدفع</label>
                    <select class="form-select" id="currency" name="DisplayCurrencyIso" required>
                        <option value="EGP">EGP - الجنيه المصري</option>
                        <option value="USD">USD - الدولار الأمريكي</option>
                        <option value="EUR">EUR - اليورو</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="customerName" class="form-label">اسم العميل</label>
                    <input type="text" class="form-control" id="customerName" name="CustomerName" placeholder="أدخل اسم العميل" required>
                </div>
                <div class="mb-3">
                    <label for="customerEmail" class="form-label">البريد الإلكتروني للعميل</label>
                    <input type="email" class="form-control" id="customerEmail" name="CustomerEmail" placeholder="example@gmail.com" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">إرسال</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
