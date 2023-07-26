<style>
  /* Estilo para as miniaturas de imagem */
  .miniatura-imagem {
    max-width: 50px; /* Defina o tamanho máximo da largura da imagem em pixels */
    max-height: 50px; /* Defina o tamanho máximo da altura da imagem em pixels (opcional) */
  }
</style>

<table class="table table-bordered">
    <tr>
        <th>Foto</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor</th>
    </tr>
    @foreach($listaItens as $item)
    <tr>
        <td><img src="{{ asset($item['foto']) }}" alt="" class="miniatura-imagem"></td>
        <td>{{ $item->nome }}</td>
        <td>{{ $item->quantidade }}</td>
        <td>{{ $item->valoritem }}</td>
    </tr>
    @endforeach
</table>
