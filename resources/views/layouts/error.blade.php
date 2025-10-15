<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error' }} - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .error-container {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin: 2rem auto;
        }
        
        .error-code {
            font-size: 6rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 1rem;
            line-height: 1;
        }
        
        .error-message {
            font-size: 1.5rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        .btn-home {
            background: #667eea;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-home:hover {
            background: #764ba2;
            transform: translateY(-2px);
            color: white;
        }
        
        @media (max-width: 576px) {
            .error-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .error-code {
                font-size: 4rem;
            }
            
            .error-message {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>