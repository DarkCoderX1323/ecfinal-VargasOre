package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/vehiculos")
public class VehiculoController {

    @Autowired
    private VehiculoService vehiculoService;

    @GetMapping
    public ResponseEntity<List<Vehiculo>> getAllVehiculos() {
        List<Vehiculo> vehiculos = vehiculoService.getAllVehiculos();
        return ResponseEntity.ok(vehiculos);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Vehiculo> getVehiculoById(@PathVariable Long id) {
        Vehiculo vehiculo = vehiculoService.getVehiculoById(id);
        return ResponseEntity.ok(vehiculo);
    }

    @PostMapping
    public ResponseEntity<Vehiculo> createVehiculo(@RequestBody Vehiculo vehiculo) {
        Vehiculo createdVehiculo = vehiculoService.createVehiculo(vehiculo);
        return ResponseEntity.ok(createdVehiculo);
    }

    @PutMapping("/{id}")
    public ResponseEntity<Vehiculo> updateVehiculo(@PathVariable Long id, @RequestBody Vehiculo vehiculo) {
        Vehiculo updatedVehiculo = vehiculoService.updateVehiculo(id, vehiculo);
        return ResponseEntity.ok(updatedVehiculo);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteVehiculo(@PathVariable Long id) {
        vehiculoService.deleteVehiculo(id);
        return ResponseEntity.noContent().build();
    }
}

