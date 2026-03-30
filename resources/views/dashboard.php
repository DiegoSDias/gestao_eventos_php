<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EventManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .card-event { transition: all 0.3s; border: none; border-radius: 12px; }
        .card-event:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .section-title { border-left: 5px solid; padding-left: 15px; margin-bottom: 25px; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="<?= URL_BASE ?>home/index">EventManager</a>
        
        <div class="dropdown ms-auto">
            <button class="btn btn-light d-flex align-items-center gap-2 border-0" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">
                    <?= strtoupper(substr($_SESSION['user_name'], 0, 1)) ?>
                </div>
                <span class="d-none d-md-inline"><?= $_SESSION['user_name'] ?></span>
                <i class="bi bi-chevron-down small"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-3" style="width: 250px; border-radius: 15px;">
                <li><h6 class="dropdown-header text-uppercase fw-bold p-0 mb-1" style="font-size: 0.75rem; color: #adb5bd;">Conta</h6></li>
                <li>
                    <div class="px-0 py-2">
                        <p class="fw-bold mb-0 text-dark"><?= $_SESSION['user_name'] ?></p>
                        <p class="text-muted mb-0 small"><?= $_SESSION['user_email'] ?></p>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded" href="<?= URL_BASE ?>user/profile"><i class="bi bi-person"></i> Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded text-danger" href="<?= URL_BASE ?>user/logout"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pb-5">

    <div class="section-title border-primary d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0">Meus Eventos</h2>
            <p class="text-muted mb-0">Gerencie os eventos que você organizou</p>
        </div>
        <a href="<?= URL_BASE ?>event/create" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Criar Novo
        </a>
    </div>

    <div class="row mb-5">
        <?php if (empty($myEvents)): ?>
            <div class="col-12"><p class="text-muted">Nenhum evento criado por você ainda.</p></div>
        <?php else: ?>
            <?php foreach ($myEvents as $e): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm card-event border-top border-primary border-4">
                        <div class="card-body">
                            <h5 class="fw-bold"><?= $e['title'] ?></h5>
                            <p class="small text-muted mb-2"><i class="bi bi-people"></i> <?= $e['number_registrations'] ?? 0 ?> Inscritos</p>
                            <p class="card-text text-secondary small"><?= mb_strimwidth($e['description'], 0, 80, "...") ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex gap-2 pb-3">
                            <a href="<?= URL_BASE ?>event/show/<?= $e['id'] ?>" class="btn btn-sm btn-light flex-fill">Ver</a>
                            <a href="<?= URL_BASE ?>event/edit/<?= $e['id'] ?>" class="btn btn-sm btn-outline-primary flex-fill">Editar</a>
                            <a href="<?= URL_BASE ?>event/delete/<?= $e['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir?')"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="section-title border-info">
        <h2 class="fw-bold mb-0 text-info">Minhas Inscrições</h2>
        <p class="text-muted mb-0">Eventos em que você garantiu sua vaga</p>
    </div>

    <div class="row mb-5">
        <?php if (empty($allEventsInscribe)): ?>
            <div class="col-12"><p class="text-muted">Você ainda não se inscreveu em nada.</p></div>
        <?php else: ?>
            <?php foreach ($allEventsInscribe as $mi): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm card-event border-start border-info border-4">
                        <div class="card-body">
                            <h5 class="fw-bold text-info"><?= $mi['title'] ?></h5>
                            <p class="small mb-1 text-muted"><i class="bi bi-calendar-check"></i> <?= date('d/m/Y H:i', strtotime($mi['event_date'])) ?></p>
                            <p class="small text-muted"><i class="bi bi-geo-alt"></i> <?= $mi['location'] ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex gap-2 pb-3">
                            <a href="<?= URL_BASE ?>event/show/<?= $mi['id'] ?>/1" class="btn btn-sm btn-outline-info w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-eye me-1"></i> Ver Detalhes
                            </a>
                            <form action="<?= URL_BASE ?>event/cancel_inscribe/<?= $mi['id'] ?>" method="POST" class="w-100">
                                <button type="submit" class="btn btn-sm btn-outline-secondary w-100 shadow-sm d-flex align-items-center justify-content-center" onclick="return confirm('Cancelar inscrição?')">Sair</button>
                            </form>
                        </div>
                      
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="section-title border-success">
        <h2 class="fw-bold mb-0 text-success">Explorar</h2>
        <p class="text-muted mb-0">Descubra novos eventos na comunidade</p>
    </div>

    <div class="row">
        <?php if (empty($allEvents)): ?>
            <div class="col-12"><p class="text-muted">Não há eventos novos para você no momento.</p></div>
        <?php else: ?>
            <?php foreach ($allEvents as $d): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm card-event">
                        <div class="card-body">
                            <h5 class="fw-bold"><?= $d['title'] ?></h5>
                            <p class="text-secondary small mb-3"><?= mb_strimwidth($d['description'], 0, 100, "...") ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary small fw-bold"><?= date('d/m/Y', strtotime($d['event_date'])) ?></span>
                                <span class="badge bg-light text-dark border"><?= $d['location'] ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex gap-2 pb-3">
                            <a href="<?= URL_BASE ?>event/show/<?= $d['id'] ?>" class="btn btn-sm btn-outline-info w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-eye me-1"></i> Detalhes
                            </a>

                            <form action="<?= URL_BASE ?>event/inscribe/<?= $d['id'] ?>" method="POST" class="w-100">
                                <button type="submit" class="btn btn-sm btn-success w-100 shadow-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-plus-lg me-1"></i> Inscrever
                                </button>
                            </form>
                        </div>
                      
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>