<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Промяна на статус на поръчка</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 10px; /* Reduced padding */
        }
        .header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            border-radius: 8px 8px 0 0;
        }

        .header2 {
            padding: 10px;
            text-align: center;
            font-size: 15px;
        }
        .content {
            padding: 10px; /* Reduced padding */
            font-size: 16px;
            color: #333333;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #999999;
        }

        .logo {
            text-align: center;
            margin-bottom: 15px; /* Reduced margin */
        }

        .order-details {
            box-sizing: border-box;
            padding: 10px 20px; /* Reduced padding */
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px; /* Reduced margin */
        }

        .order-details th,
        .order-details td {
            padding: 10px 0; /* Reduced padding */
            font-size: 14px;
            color: #333;
        }

        .order-details th {
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #007BFF;
        }

        .order-details td {
            border-bottom: 1px solid #eee;
        }

        .order-details th:first-child, 
        .order-details td:first-child {
            width: 50%;
        }

        .order-details th:nth-child(2), 
        .order-details td:nth-child(2),
        .order-details th:nth-child(3), 
        .order-details td:nth-child(3) {
            width: 15%;
        }

        .order-details th:last-child, 
        .order-details td:last-child {
            width: 20%;
            text-align: right;
        }

        .order-details .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .subtotal {
            text-align: right;
            margin: 0;
            font-size: 18px;
            padding: 10px 0; /* Reduced padding */
        }

        .total1 {
            text-align: right;
            margin: 0;
            font-size: 16px;
            padding: 10px 0; /* Reduced padding */
        }

        .small-text {
            color: #989b9e;
        }

        .support-section {
    display: flex;
    justify-content: center;
    align-items: center; /* Centers items vertically */
    text-align: center;
    padding: 10px 0;
}

.support-text {
    font-size: 12px; /* Make the text smaller */
    color: #999999;
    margin-right: 10px; /* Adds space between the text and the logo */
}

.support-section img {
    max-width: 150px; /* Adjust the size of the logo */
    vertical-align: middle;
}


    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="https://demo.workshopreport.online/Logo-tachoamarket.png" alt="Tachoamarket Logo" style="max-width: 400px;">
        </div>
        <div class="header">
            Поръчка <strong>№%order_id%</strong> е приета успешно
        </div>
        <div class="content">
            <div class="order-details">
                <table>
                    <thead>
                        <tr>
                            <th>Продукт</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th style="text-align: right;">Общо</th>
                        </tr>
                    </thead>
                    <tbody>
                        %products_template%
                    </tbody>
                </table>
                <p class="total1">
                    Стoйност: <span style="padding-left: 25px;">%amount% лв. / %amount_euro% €</span><br>
                    Остъпка 10%: <span style="padding-left: 25px;">-%discount% лв. / -%discount_euro% €</span><br>
                    Нето: <span style="padding-left: 25px;">%total% лв. / %total_euro% €</span><br>
                    <br>
                    ДДС<span style="padding-left: 25px;">%vat% лв. / %vat_euro% €</span><br>
                </p>
                <p class="subtotal">
                    <b>Общо: <span style="padding-left: 25px;">%subtotal% лв. / %subtotal_euro% €</span></b><br>
                </p>
            </div>
<br>
            <!-- New Section for Shipping Address, Phone, and Contact Person -->
            <div class="order-details">
                <h3 style="text-align: center; font-size: 20px; margin-bottom: 10px;">Данни за доставка</h3>
                <p>Лице за контакт: %first_name% %last_name%</p>
                <p>Телефон за връзка: %tel%</p>
                <p>Тип на доставка: %speedy%</p>
                <p>Адрес за доставка: %address_street%</p>
                <p>Начин на плащане: %payment_method%</p>
            </div>
<br>
            <div class="order-details">
                <h3 style="text-align: center; font-size: 20px; margin-bottom: 10px;">Данни за фактуриране</h3>
                <p>Име на фирма: %company%</p>
                <p>Адрес: %company_address%</p>
                <p>МОЛ: %mol%</p>
                <p>ДДС: %dds%</p>
                <p>ЕИК: %eik%</p>
            </div>
            

            <div class="header2">
                Благодарим Ви, че избрахте да пазарувате от TACHOAMARKET.BG
            </div>
        </div>

        <div class="support-section">
    <span class="support-text">Тази платформа се поддържа от</span>
    <img src="https://demo.workshopreport.online/Logo-28082024.png" alt="Tachos Logo">
</div>


        <div class="footer">
            &copy; 2025, ТАХОС ЕООД.
        </div>
    </div>

</body>
</html>
