<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestão de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h5 class="mb-0">Acessar Sistema</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="<?= URL_BASE ?>user/authenticate" method="POST">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="seu@email.com">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Entrar</button>

                            <?php if (isset($erros)): ?>
                                <div class="alert alert-danger alert-dismissible fade show text-center small mt-4" role="alert">
                                    <?= $erros; ?>
                                </div>
                            <?php endif; ?>

                        
                            <hr>
                            <p class="text-center mb-0">
                                Não tem conta? <a href="<?= URL_BASE ?>user/create">Cadastre-se</a>
                            </p>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

</body>
</html>