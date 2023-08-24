package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class EmpresaService {

    @Autowired
    private EmpresaRepository empresaRepository;

    public List<Empresa> getAllEmpresas() {
        return empresaRepository.findAll();
    }

    public Empresa getEmpresaById(Long id) {
        return empresaRepository.findById(id).orElse(null);
    }

    public Empresa createEmpresa(Empresa empresa) {
        return empresaRepository.save(empresa);
    }

    public Empresa updateEmpresa(Long id, Empresa empresa) {
        if (empresaRepository.existsById(id)) {
            empresa.setId(id);
            return empresaRepository.save(empresa);
        }
        return null;
    }

    public void deleteEmpresa(Long id) {
        empresaRepository.deleteById(id);
    }
}

