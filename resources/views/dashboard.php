<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestão de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">EventManager</a>
        
        <div class="dropdown ms-auto">
            <button class="btn btn-light d-flex align-items-center gap-2 border-0" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <?= strtoupper(substr($_SESSION['user_name'], 0, 1)) ?>
                </div>
                <span class="d-none d-md-inline"><?= $_SESSION['user_name'] ?></span>
                <i class="bi bi-chevron-down small"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-3" aria-labelledby="dropdownUser" style="width: 250px; border-radius: 15px;">
                <li>
                    <h6 class="dropdown-header text-uppercase fw-bold p-0 mb-1" style="font-size: 0.75rem; color: #adb5bd;">Conta</h6>
                </li>
                <li>
                    <div class="px-0 py-2">
                        <p class="fw-bold mb-0 text-dark"><?= $_SESSION['user_name'] ?></p>
                        <p class="text-muted mb-0 small"><?= $_SESSION['user_email'] ?></p>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded" href="<?= URL_BASE ?>user/profile?id=<?= $_SESSION['user_id'] ?>">
                        <i class="bi bi-person"></i> Perfil
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded text-danger" href="<?= URL_BASE ?>user/logout">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Meus Eventos</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= URL_BASE ?>event/create" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Novo Evento
            </a>
        </div>
    </div>

    <?php if (empty($eventos)): ?>
        <div class="alert alert-info text-center py-5">
            <i class="bi bi-calendar-event fs-1"></i>
            <p class="mt-3">Você ainda não criou nenhum evento.</p>
            <a href="<?= URL_BASE ?>event/create" class="btn btn-primary">Comece agora!</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($eventos as $evento): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= $evento->getTitulo() ?></h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-calendar"></i> <?= date('d/m/Y', strtotime($evento->getData())) ?>
                            </p>
                            <p class="card-text"><?= substr($evento->getDescricao(), 0, 100) ?>...</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                            <a href="<?= URL_BASE ?>event/edit/<?= $evento->getId() ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                            <a href="<?= URL_BASE ?>event/delete/<?= $evento->getId() ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>