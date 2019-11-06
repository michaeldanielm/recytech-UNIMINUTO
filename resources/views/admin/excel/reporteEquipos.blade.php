<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Planta</th>
      <th>Departamento</th>
      <th>Jefe directo</th>
      <th>Tipo</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Número de serie</th>
      <th>Sistema operativo</th>
      <th>Procesador</th>
      <th>RAM</th>
      <th>Disco duro</th>
      <th>MAC</th>
      <th>Descripción/Notas</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($equipos as $equipo)
      <tr>
        <td>{{$equipo->id_equipo}}</td>
        @isset($equipo->equipoPersona->persona)
          <td>{{$equipo->equipoPersona->persona->nombre}}</td>
          <td>{{$equipo->equipoPersona->persona->ubicacion->planta}}</td>
          <td>{{$equipo->equipoPersona->persona->ubicacion->departamento}}</td>
          <td>{{$equipo->equipoPersona->persona->jefe}}</td>
        @else
          <td><span>Sin asignar</span></td>
          <td><span>Sin asignar</span></td>
          <td><span>Sin asignar</span></td>
          <td><span>Sin asignar</span></td>
        @endisset
        <td>{{$equipo->tipo}}</td>
        <td>{{$equipo->marca}}</td>
        <td>{{$equipo->modelo}}</td>
        <td>{{$equipo->ns}}</td>
        <td>{{$equipo->sistema_operativo}}</td>
        <td>{{$equipo->procesador}}</td>
        <td>{{$equipo->ram}}</td>
        <td>{{$equipo->disco_duro}}</td>
        <td>{{$equipo->mac}}</td>
        <td>{{$equipo->descripcion}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
