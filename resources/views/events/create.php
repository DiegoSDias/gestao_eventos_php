<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Evento - EventManager</title>
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
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 text-primary">Criar Novo Evento</h3>
                    
                    <form action="<?= URL_BASE ?>event/store" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Título do Evento</label>
                            <input type="text" name="title" class="form-control" placeholder="Ex: Workshop de PHP MVC" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Data e Horário</label>
                                <input type="datetime-local" name="event_date" class="form-control" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Local</label>
                                <input type="text" name="location" class="form-control" placeholder="Ex: Auditório Central ou Zoom" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Descrição Detalhada</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Conte mais sobre o que vai acontecer no evento..."></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= URL_BASE ?>home/index" class="btn btn-light px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5">Publicar Evento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>