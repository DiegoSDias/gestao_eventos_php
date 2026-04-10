<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $event['title'] ?> - Detalhes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <a href="<?= URL_BASE ?>home/index" class="btn btn-link text-decoration-none p-0 mb-3">
                <i class="bi bi-arrow-left"></i> Voltar ao Dashboard
            </a>

            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h1 class="fw-bold text-primary mb-1"><?= $event['title'] ?></h1>
                            <span class="badge bg-soft-primary text-primary border border-primary">
                                <i class="bi bi-people-fill"></i> <?= $event['number_registrations'] ?? 0 ?> Inscritos
                            </span>
                        </div>
                        <?php if($event['created_by'] == $_SESSION['user_id']): ?>
                            <div class="btn-group">
                                <a href="<?= URL_BASE ?>event/edit/<?= $event['id'] ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted fw-bold small text-uppercase">Data e Hora</h6>
                            <p class="fs-5"><i class="bi bi-calendar-event text-primary"></i> <?= date('d/m/Y H:i', strtotime($event['event_date'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted fw-bold small text-uppercase">Localização</h6>
                            <p class="fs-5"><i class="bi bi-geo-alt text-danger"></i> <?= $event['location'] ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h6 class="text-muted fw-bold small text-uppercase mb-3">Sobre o Evento</h6>
                        <div class="text-secondary lh-lg" style="white-space: pre-line;">
                            <?= $event['description'] ?>
                        </div>
                    </div>
                </div>
                <?php if(!$inscrito): ?>
                    <form action="<?= URL_BASE ?>event/inscribe/<?= $event['id'] ?>" method="POST" class="w-100 d-flex justify-content-center mb-4">
                        <button type="submit" class="btn btn-success w-50 shadow-sm d-flex align-items-center justify-content-center py-2 fs-5">
                            <i class="bi bi-plus-lg me-2"></i> Inscrever
                        </button>
                    </form>
                <?php else: ?>
                    <div class="w-100 d-flex justify-content-center mb-4">
                        <span class="btn btn-success w-50 shadow-sm d-flex align-items-center justify-content-center py-2 fs-5">Você já está inscrito!</span>
                    </div>
                <?php endif; ?>
                
                <div class="card-footer bg-white p-4 border-top-0 text-center">
                    <p class="text-muted small">Evento criado em: <?= $event->created_at->format('d/m/Y') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>