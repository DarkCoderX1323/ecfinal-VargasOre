package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class VehiculoService {

    @Autowired
    private VehiculoRepository vehiculoRepository;

    public List<Vehiculo> getAllVehiculos() {
        return vehiculoRepository.findAll();
    }

    public Vehiculo getVehiculoById(Long id) {
        return vehiculoRepository.findById(id).orElse(null);
    }

    public Vehiculo createVehiculo(Vehiculo vehiculo) {
        return vehiculoRepository.save(vehiculo);
    }

    public Vehiculo updateVehiculo(Long id, Vehiculo vehiculo) {
        if (vehiculoRepository.existsById(id)) {
            vehiculo.setId(id);
            return vehiculoRepository.save(vehiculo);
        }
        return null;
    }

    public void deleteVehiculo(Long id) {
        vehiculoRepository.deleteById(id);
    }
}

