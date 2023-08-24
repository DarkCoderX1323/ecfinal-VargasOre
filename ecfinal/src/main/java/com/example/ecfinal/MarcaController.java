package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/marcas")
public class MarcaController {

    @Autowired
    private MarcaService marcaService;

    @GetMapping
    public ResponseEntity<List<Marca>> getAllMarcas() {
        List<Marca> marcas = marcaService.getAllMarcas();
        return ResponseEntity.ok(marcas);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Marca> getMarcaById(@PathVariable Long id) {
        Marca marca = marcaService.getMarcaById(id);
        return ResponseEntity.ok(marca);
    }

    @PostMapping
    public ResponseEntity<Marca> createMarca(@RequestBody Marca marca) {
        Marca createdMarca = marcaService.createMarca(marca);
        return ResponseEntity.ok(createdMarca);
    }

    @PutMapping("/{id}")
    public ResponseEntity<Marca> updateMarca(@PathVariable Long id, @RequestBody Marca marca) {
        Marca updatedMarca = marcaService.updateMarca(id, marca);
        return ResponseEntity.ok(updatedMarca);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteMarca(@PathVariable Long id) {
        marcaService.deleteMarca(id);
        return ResponseEntity.noContent().build();
    }
}

