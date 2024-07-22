<?php
namespace App\Visitors;

use App\Models\SystemLog;

class LogVisitor implements Visitor {
    public function visitLog(SystemLog $log) {
        // Implementar a lógica que deseja aplicar ao log
        // Por exemplo, adicionar mais informações aos logs ou formatar a saída
        $log->extra_info = 'Informação adicional';
    }
}
