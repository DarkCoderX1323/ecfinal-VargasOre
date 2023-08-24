package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PersonaService {

    @Autowired
    private PersonaRepository personaRepository;

    public List<Persona> getAllPersonas() {
        return personaRepository.findAll();
    }

    public Persona getPersonaById(Long id) {
        return personaRepository.findById(id).orElse(null);
    }

    public Persona createPersona(Persona persona) {
        return personaRepository.save(persona);
    }

    public Persona updatePersona(Long id, Persona persona) {
        if (personaRepository.existsById(id)) {
            persona.setId(id);
            return personaRepository.save(persona);
        }
        return null;
    }

    public void deletePersona(Long id) {
        personaRepository.deleteById(id);
    }
}

