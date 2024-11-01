<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema RH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            width: 18rem;
            text-align: center;
        }
        .icon {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 15px;
        }
        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Botão de voltar para a tela de login -->
        <div class="text-start mb-3">
            <a href="login.html" class="btn btn-secondary">Voltar para Login</a>
        </div>

        <!-- Seção de boas-vindas -->
        <div class="welcome-section">
            <h1>Bem-vindo ao Sistema RH</h1>
            <p>Selecione uma funcionalidade para gerenciar o RH da sua empresa:</p>
        </div>

        <!-- Cards de funcionalidades -->
        <div class="card-container">
            <div class="card shadow">
                <div class="card-body">
                    <i class="fas fa-users icon"></i>
                    <h5 class="card-title">Gerenciar Funcionários</h5>
                    <p class="card-text">Adicione, visualize e gerencie informações dos funcionários.</p>
                    <a href="funcionarios.html" class="btn btn-primary">Acessar</a>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <i class="fas fa-user-plus icon"></i>
                    <h5 class="card-title">Gerenciar Recrutamento</h5>
                    <p class="card-text">Controle os processos seletivos e recrutamento de novos talentos.</p>
                    <a href="recrutamento.html" class="btn btn-primary">Acessar</a>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <i class="fas fa-star icon"></i>
                    <h5 class="card-title">Avaliações de Desempenho</h5>
                    <p class="card-text">Gerencie e registre avaliações de desempenho dos funcionários.</p>
                    <a href="avaliacoes.html" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
