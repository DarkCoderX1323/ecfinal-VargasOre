package com.example.ecfinal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/personas")
public class PersonaController {

    @Autowired
    private PersonaService personaService;

    @GetMapping
    public ResponseEntity<List<Persona>> getAllPersonas() {
        List<Persona> personas = personaService.getAllPersonas();
        return ResponseEntity.ok(personas);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Persona> getPersonaById(@PathVariable Long id) {
        Persona persona = personaService.getPersonaById(id);
        return ResponseEntity.ok(persona);
    }

    @PostMapping
    public ResponseEntity<Persona> createPersona(@RequestBody Persona persona) {
        Persona createdPersona = personaService.createPersona(persona);
        return ResponseEntity.ok(createdPersona);
    }

    @PutMapping("/{id}")
    public ResponseEntity<Persona> updatePersona(@PathVariable Long id, @RequestBody Persona persona) {
        Persona updatedPersona = personaService.updatePersona(id, persona);
        return ResponseEntity.ok(updatedPersona);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deletePersona(@PathVariable Long id) {
        personaService.deletePersona(id);
        return ResponseEntity.noContent().build();
    }
}

