import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../styles.css';

const Marcas = () => {
  const [marcas, setMarcas] = useState([]);
  const [formData, setFormData] = useState({
    id: null,
    nombre: '',
    origen: ''
  });
  const [editing, setEditing] = useState(false);

  useEffect(() => {
    fetchMarcas();
  }, []);

  const fetchMarcas = async () => {
    try {
      const response = await axios.get('http://localhost:8081/api/marcas');
      setMarcas(response.data);
    } catch (error) {
      console.error('Error fetching marcas:', error);
    }
  };

  const handleInputChange = event => {
    const { name, value } = event.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleAddEditSubmit = async event => {
    event.preventDefault();
    if (editing) {
      try {
        await axios.put(`http://localhost:8081/api/marcas/${formData.id}`, formData);
        setEditing(false);
      } catch (error) {
        console.error('Error updating marca:', error);
      }
    } else {
      try {
        await axios.post('http://localhost:8081/api/marcas', formData);
      } catch (error) {
        console.error('Error creating marca:', error);
      }
    }
    setFormData({
      id: null,
      nombre: '',
      origen: ''
    });
    fetchMarcas();
  };

  const handleEdit = marca => {
    setFormData({
      id: marca.id,
      nombre: marca.nombre,
      origen: marca.origen
    });
    setEditing(true);
  };

  const handleDelete = async id => {
    try {
      await axios.delete(`http://localhost:8081/api/marcas/${id}`);
      fetchMarcas();
    } catch (error) {
      console.error('Error deleting marca:', error);
    }
  };

  return (
    <div className="table-container">
      <h1>Lista de Marcas</h1>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Origen</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {marcas.map(marca => (
            <tr key={marca.id}>
              <td>{marca.nombre}</td>
              <td>{marca.origen}</td>
              <td>
                <button onClick={() => handleEdit(marca)}>Editar</button>
                <button onClick={() => handleDelete(marca.id)}>Eliminar</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <h2>{editing ? 'Editar Marca' : 'Agregar Marca'}</h2>
      <form onSubmit={handleAddEditSubmit}>
        <input
          type="text"
          name="nombre"
          placeholder="Nombre"
          value={formData.nombre}
          onChange={handleInputChange}
        />
        <input
          type="text"
          name="origen"
          placeholder="Origen"
          value={formData.origen}
          onChange={handleInputChange}
        />
        <button type="submit">{editing ? 'Guardar Cambios' : 'Agregar Marca'}</button>
      </form>
    </div>
  );
};

export default Marcas;
