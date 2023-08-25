import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../styles.css';

const Vehiculos = () => {
  const [vehiculos, setVehiculos] = useState([]);
  const [marcas, setMarcas] = useState([]);
  const [formData, setFormData] = useState({
    id: null,
    modelo: '',
    anho: 0,
    precio: 0,
    marcaId: null
  });
  const [editing, setEditing] = useState(false);

  useEffect(() => {
    fetchVehiculos();
    fetchMarcas();
  }, []);

  const fetchVehiculos = async () => {
    try {
      const response = await axios.get('http://localhost:8081/api/vehiculos');
      setVehiculos(response.data);
    } catch (error) {
      console.error('Error fetching vehiculos:', error);
    }
  };

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
        await axios.put(`http://localhost:8081/api/vehiculos/${formData.id}`, formData);
        setEditing(false);
      } catch (error) {
        console.error('Error updating vehiculo:', error);
      }
    } else {
      try {
        await axios.post('http://localhost:8081/api/vehiculos', formData);
      } catch (error) {
        console.error('Error creating vehiculo:', error);
      }
    }
    setFormData({
      id: null,
      modelo: '',
      año: 0,
      precio: 0,
      marcaId: null
    });
    fetchVehiculos();
  };

  const handleEdit = vehiculo => {
    setFormData({
      id: vehiculo.id,
      modelo: vehiculo.modelo,
      año: vehiculo.anho,
      precio: vehiculo.precio,
      marcaId: vehiculo.marcaId
    });
    setEditing(true);
  };

  const handleDelete = async id => {
    try {
      await axios.delete(`http://localhost:8081/api/vehiculos/${id}`);
      fetchVehiculos();
    } catch (error) {
      console.error('Error deleting vehiculo:', error);
    }
  };

  return (
    <div className="table-container">
      <h1>Lista de Vehiculos</h1>
      <table>
        <thead>
          <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {vehiculos.map(vehiculo => (
            <tr key={vehiculo.id}>
              <td>{marcas.find(marca => marca.id === vehiculo.marcaId)?.nombre}</td>
              <td>{vehiculo.modelo}</td>
              <td>{vehiculo.año}</td>
              <td>{vehiculo.precio}</td>
              <td>
                <button onClick={() => handleEdit(vehiculo)}>Editar</button>
                <button onClick={() => handleDelete(vehiculo.id)}>Eliminar</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <h2>{editing ? 'Editar Vehiculo' : 'Agregar Vehiculo'}</h2>
      <form onSubmit={handleAddEditSubmit}>
        <input
          type="text"
          name="modelo"
          placeholder="Modelo"
          value={formData.modelo}
          onChange={handleInputChange}
        />
        <input
          type="number"
          name="año"
          placeholder="Año"
          value={formData.año}
          onChange={handleInputChange}
        />
        <input
          type="number"
          name="precio"
          placeholder="Precio"
          value={formData.precio}
          onChange={handleInputChange}
        />
        <select
          name="marcaId"
          value={formData.marcaId}
          onChange={handleInputChange}
        >
          <option value={null}>Seleccionar Marca</option>
          {marcas.map(marca => (
            <option key={marca.id} value={marca.id}>{marca.nombre}</option>
          ))}
        </select>
        <button type="submit">{editing ? 'Guardar Cambios' : 'Agregar Vehiculo'}</button>
      </form>
    </div>
  );
};

export default Vehiculos;
