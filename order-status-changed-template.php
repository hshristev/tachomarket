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
            background-color: #F58634;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 24px;
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
            border-bottom: 2px solid #F58634;
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
            Поръчка <strong>№%order_id%</strong> беше променена на статус: <strong>%new_status%</strong>
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
