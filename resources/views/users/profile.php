<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - EventManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <a href="<?= URL_BASE ?>home/index" class="btn btn-link text-decoration-none p-0 mb-3">
                <i class="bi bi-arrow-left"></i> Voltar ao Dashboard
            </a>

            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h4 class="card-title fw-bold mb-4">Editar Perfil</h4>
                    
                    <form action="<?= URL_BASE ?>user/update" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">NOME COMPLETO*</label>
                            <input type="text" name="name" class="form-control form-control-lg" value="<?= $_SESSION['user_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">E-MAIL*</label>
                            <input type="email" name="email" class="form-control form-control-lg" value="<?= $_SESSION['user_email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">NOVA SENHA (se desejar trocar)</label>
                            <input type="password" name="password" class="form-control form-control-lg">
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-danger shadow-sm mb-5" style="border-radius: 15px; border-style: dashed;">
                <div class="card-body p-4">
                    <h5 class="text-danger fw-bold"><i class="bi bi-exclamação-triangle"></i> Zona de Perigo</h5>
                    <p class="text-muted small">Ao apagar sua conta, todos os seus eventos criados serão removidos permanentemente. Esta ação não pode ser desfeita.</p>
                    
                    <form action="<?= URL_BASE ?>user/delete" method="POST" onsubmit="return confirm('TEM CERTEZA? Todos os seus dados serão apagados permanentemente.');">
                        <button type="submit" class="btn btn-outline-danger w-100">
                            Apagar minha conta permanentemente
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>