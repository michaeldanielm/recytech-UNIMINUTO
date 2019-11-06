<table>
  <thead>
    <tr>
      <th>Modelo de toner</th>
      <th>Lugar</th>
      <th>Cantidad</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($consumo as $registro)
      <tr>
        <td>{{$registro->inventario->cartucho->modelo}}</td>
        <td>{{$registro->impresoraUbicacion->ubicacion->planta}} {{$registro->impresoraUbicacion->ubicacion->departamento}}</td>
        <td>{{$registro->cantidad}}</td>
        <td>{{date('d-m-Y',strtotime($registro->created_at))}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
