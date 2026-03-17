<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento - EventManager</title>
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
                    <h3 class="fw-bold mb-4 text-primary">Editar Evento</h3>
                    
                    <form action="<?= URL_BASE ?>event/update" method="POST">
                        
                        <input type="hidden" name="id" value="<?= $event['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Título do Evento</label>
                            <input type="text" name="title" class="form-control" 
                                   value="<?= $event['title'] ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Data e Horário</label>
                                <input type="datetime-local" name="event_date" class="form-control" 
                                       value="<?= date('Y-m-d\TH:i', strtotime($event['event_date'])) ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Local</label>
                                <input type="text" name="location" class="form-control" 
                                       value="<?= $event['location'] ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Descrição Detalhada</label>
                            <textarea name="description" class="form-control" rows="5"><?= $event['description'] ?></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-3">
                            <a href="<?= URL_BASE ?>home/index" class="btn btn-light px-4">Cancelar</a>
                            <button type="submit" class="btn btn-success px-5">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>