<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Account Recovery</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .google-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .google-logo img {
            width: 72px;
        }

        h1 {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1rem;
            text-align: center;
        }

        p {
            font-size: 0.875rem;
            color: #5f6368;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        input {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        input:focus {
            border-color: #4285f4;
            outline: none;
        }

        button {
            background-color: #1a73e8;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
        }

        button:hover {
            background-color: #1659b7;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="google-logo">
            <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png" alt="Google Logo">
        </div>
        <h1>Account Recovery</h1>
        <p>To recover your Google account, please fill in the following information:</p>

        <!-- Separate form for each employee -->
        <form action="{{ route('phishing.simulation.submitForm', ['simulation' => $simulation->id, 'employee' => $employee->id]) }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Submit</button>
        </form>

    </div>
</body>

</html>