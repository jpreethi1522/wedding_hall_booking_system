<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .thank-you-message {
            font-size: 3em;
            color: #4CAF50;
            animation: fadeIn 2s ease-in-out;
        }

        .message {
            font-size: 1.5em;
            color: #333;
            margin-top: 20px;
        }

        .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px 0;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        @keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
        }
    </style>
   <script>
    // Automatically reload the previous page after 5 seconds
    window.onload = function() {
        setTimeout(function() {
            window.history.back();
        }, 5000); // 5000 milliseconds = 5 seconds
    }
</script>

</head>
<body>
    <div class="container">
        <h1 class="thank-you-message">Thank You!</h1>
        <p class="message">Please check your email.</p>
        <!-- The Go Back button is no longer needed -->
    </div>
</body>
</html>
