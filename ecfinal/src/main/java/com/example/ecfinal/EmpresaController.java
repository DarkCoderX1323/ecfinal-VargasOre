package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/empresas")
public class EmpresaController {

    @Autowired
    private EmpresaService empresaService;

    @GetMapping
    public ResponseEntity<List<Empresa>> getAllEmpresas() {
        List<Empresa> empresas = empresaService.getAllEmpresas();
        return ResponseEntity.ok(empresas);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Empresa> getEmpresaById(@PathVariable Long id) {
        Empresa empresa = empresaService.getEmpresaById(id);
        return ResponseEntity.ok(empresa);
    }

    @PostMapping
    public ResponseEntity<Empresa> createEmpresa(@RequestBody Empresa empresa) {
        Empresa createdEmpresa = empresaService.createEmpresa(empresa);
        return ResponseEntity.ok(createdEmpresa);
    }

    @PutMapping("/{id}")
    public ResponseEntity<Empresa> updateEmpresa(@PathVariable Long id, @RequestBody Empresa empresa) {
        Empresa updatedEmpresa = empresaService.updateEmpresa(id, empresa);
        return ResponseEntity.ok(updatedEmpresa);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteEmpresa(@PathVariable Long id) {
        empresaService.deleteEmpresa(id);
        return ResponseEntity.noContent().build();
    }
}

