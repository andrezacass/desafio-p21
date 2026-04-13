<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Cartórios - P24h</title>
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://pin.it/5jKyHe6Xh');
            background-size: cover; background-position: center; background-attachment: fixed;
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.98); padding: 40px; border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3); width: 95%; max-width: 1150px; margin: 20px;
        }

        .header-box { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        h1 { color: #1a365d; margin: 0; font-size: 26px; }

        .btn-new {
            background: #1a365d; color: white; padding: 12px 25px; text-decoration: none;
            border-radius: 25px; font-weight: bold; font-size: 14px; transition: 0.3s;
        }
        .btn-new:hover { background: #2a4365; transform: scale(1.05); }

        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; color: #718096; font-size: 12px; text-transform: uppercase; border-bottom: 2px solid #edf2f7; }
        td { padding: 15px; border-bottom: 1px solid #edf2f7; color: #2d3748; font-size: 14px; }
        tr:hover { background-color: #f7fafc; }

        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; text-align: center; }
        .status-active { background: #c6f6d5; color: #22543d; }
        .status-inactive { background: #fed7d7; color: #822727; }

        .btn-acao { font-size: 12px; font-weight: bold; text-decoration: none; text-transform: uppercase; margin-right: 10px; }
        .btn-edit { color: #3182ce; }
        .btn-delete { background: none; border: none; color: #e53e3e; cursor: pointer; padding: 0; font-family: inherit; font-size: 12px; font-weight: bold; text-transform: uppercase; }

        footer { text-align: center; margin-top: 30px; color: #a0aec0; font-size: 12px; border-top: 1px solid #edf2f7; padding-top: 20px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-box">
            <h1>Cadastros Realizados</h1>
            <a href="{{ route('cartorios.create') }}" class="btn-new">CADASTRAR NOVO CARTÓRIO</a>
        </div>

        <table>
            <thead> <!-- Cabeçalho da tabela com os títulos das colunas -->
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Tabelião</th>
                    <th>Município</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir cada cartório na tabela, ou uma mensagem caso não haja registros -->
                @forelse($cartorios as $cartorio)
                    <tr>
                        <td style="font-weight: 600;">{{ $cartorio->nome }}</td>
                        <td>{{ $cartorio->cnpj }}</td>
                        <td>{{ $cartorio->nome_tabeliao }}</td>
                        
                        <td>
                            {{ $cartorio->municipio->nome ?? 'N/A' }}
                            @if(isset($cartorio->municipio->estado))
                                - {{ $cartorio->municipio->estado->uf }}
                            @endif
                        </td>
                        
                        
                        <td style="text-align: center;">
                            <!-- Exibe um badge de status com cores diferentes para ativo e inativo -->
                            <span class="status-badge {{ $cartorio->ativo ? 'status-active' : 'status-inactive' }}">
                                {{ $cartorio->ativo ? 'ATIVO' : 'INATIVO' }}
                            </span>
                        </td>

                        <td style="text-align: center;">
                            <a href="{{ route('cartorios.edit', $cartorio->id) }}" class="btn-acao btn-edit">EDITAR</a>
                            <form action="{{ route('cartorios.destroy', $cartorio->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Excluir este cartório?')">EXCLUIR</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #a0aec0;">Nenhum cartório encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <footer>
            Desenvolvido por <strong>Cassandra</strong> 2026
        </footer>
    </div>

</body>
</html>